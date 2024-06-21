<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Auth user
        $user = Auth::user();
        // dd(Auth::user());

        $apartments = Apartment::where('user_id', $user->id)->orderByDesc('id')->get();

        // dd($apartments);

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $nations = config('nation');
        $sponsorships = Sponsorship::all();

        return view('admin.apartments.create', compact('services', 'sponsorships', 'nations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();  // Id user authenticated

        /* generate slug based on apartment title */
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        /* if I upload an image, save image path */
        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $validated['image']);
            $validated['image'] = $img_path;
        }

        /* if I have the address in the request, I have to update latitude and longitude of that address ->api call to tom tom */
        /* https://developer.tomtom.com/geocoding-api/api-explorer   structured geocoding */
        if ($request->has('address') && $request['address'] != '') {
            /* save data for api call NORMAL */
            $api_key = env('TOMTOM_API_KEY');
            $base_api = 'https://api.tomtom.com/search/2/geocode/';
            $address = str_replace(' ', '%20', $validated['address']); //20 zoom level

            /* EDGE CASE: some addresses aren't present in tomtom */
            /* $base_api = 'https://api.tomtom.com/search/2/structuredGeocode.json?'; */
            /* $street_number = $validated['street_number'];
            $country_code = $validated['country_code'];
            $zip_code = $validated['zip_code'];
            $city = $validated['city']; */

            /* if ($request->has('country_code', 'street_number', 'zip_code', 'city') && $country_code != null && $zip_code != null && $city != null && $street_number != null) { */

            /* create api url */
            /* $api_url = $base_api.'countryCode='.$country_code.'&streetNumber='.$street_number.'&streetName='.$address.'&municipality='.$city.'&postalCode='.$zip_code.'&view=Unified&key='.$api_key; */
            $api_url = $base_api . $address . '.json?storeResult=false&view=Unified&key=' . $api_key;

            /* save coordinates */
            /* $coordinates = json_decode(file_get_contents($api_url))->results[0]->position; */
            //dd($coordinates);

            /* bypass SSL certificate error */
            $client = new Client(['verify' => false]);

            /* $client->get returns a json response that must be decoded into assoc array -> get results -> 0 */
            $result = json_decode($client->get($api_url)->getBody(), true)['results'][0];

            /* save coordinates */
            $coordinates = $result['position'];
            /* dd($coordinates); */

            /* save lat and long */
            $latitude = $coordinates['lat'];
            $longitude = $coordinates['lon'];
            /* dd($latitude, $longitude); */

            /* save in db */
            $validated['latitude'] = $latitude;
            $validated['longitude'] = $longitude;
            /* } */
        }

        /* create new apartment using validated data*/
        $apartment = Apartment::create($validated);

        /* if I select services, attach selected services to apartment */
        if ($request->has('services')) {
            $apartment->services()->attach($validated['services']);
        }

        /* return to index route with success message */
        return to_route('admin.apartments.index')->with('message', 'Apartment inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        // User auth
        if ($apartment->user_id !== Auth::id()) {
            abort(403, 'This is not your apartment!');
        }

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        // User auth
        if ($apartment->user_id !== Auth::id()) {
            abort(403, 'This is not your apartment!');
        }

        $services = Service::all();
        $nations = config('nation');

        return view('admin.apartments.edit', compact('apartment', 'services', 'nations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $validated = $request->validated();
        /* generate slug based on apartment title that might have been changed */
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        /* if I upload a different img, delete the old one from storage and save the new img path */
        if ($request->has('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $img_path = Storage::put('uploads', $validated['image']);
            $validated['image'] = $img_path;
        }

        if ($request->has('address') && $request['address'] != '') {
            /* save data for api call NORMAL */
            $api_key = env('TOMTOM_API_KEY');
            $base_api = 'https://api.tomtom.com/search/2/geocode/';
            $address = str_replace(' ', '%20', $validated['address']); //20 zoom level            

            /* create api url */
            $api_url = $base_api . $address . '.json?storeResult=false&view=Unified&key=' . $api_key;

            /* save coordinates */

            /* bypass SSL certificate error */
            $client = new Client(['verify' => false]);

            /* $client->get returns a json response that must be decoded into assoc array -> get results -> 0 */
            $result = json_decode($client->get($api_url)->getBody(), true)['results'][0];

            /* save coordinates */
            $coordinates = $result['position'];
            /* dd($coordinates); */

            /* save lat and long */
            $latitude = $coordinates['lat'];
            $longitude = $coordinates['lon'];
            /* dd($latitude, $longitude); */

            /* save in db */
            $validated['latitude'] = $latitude;
            $validated['longitude'] = $longitude;
        }

        /* if I have services in the request, sync them, otherwise sync an empty array */
        if ($request->has('services')) {
            $apartment->services()->sync($validated['services']);
        }
        /* if I change the address in the request, I have to update latitude and longitude of that address ->api call to tom tom */

        /* update apartment data */
        $apartment->update($validated);

        return to_route('admin.apartments.index')->with('message', "Your apartment $apartment->title has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        // User auth
        if ($apartment->user_id !== Auth::id()) {
            abort(403, 'This is not your apartment!');
        }

        $apartment->services()->detach();

        if ($apartment->image) {
            Storage::delete($apartment->image);
        }

        $apartment->delete();

        return to_route('admin.apartments.index')->with('message', "Your apartment $apartment->title has been deleted successfully");
    }
}
