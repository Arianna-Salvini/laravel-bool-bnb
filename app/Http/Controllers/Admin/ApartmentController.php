<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.create', compact('services', 'sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $validated = $request->validated();
        
        /* generate slug based on apartment title */
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        /* if I upload an image, save image path */
        if($request->has('image')){
            $img_path = Storage::put('uploads', $validated['image']);
            $validated['image'] = $img_path;
        }

        /* if I have the address in the request, I have to update latitude and longitude of that address ->api call to tom tom */
        /* https://developer.tomtom.com/geocoding-api/api-explorer   structured geocoding */




        /* create new apartment using validated data*/
        $apartment = Apartment::create($validated);

        /* if I select services, attach selected services to apartment */
        if($request->has('services')){
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
