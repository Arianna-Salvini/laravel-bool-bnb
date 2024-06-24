<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'sponsorships', 'user')->orderByDesc('id')->paginate(4);

        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::with('services', 'sponsorships', 'user')->where('slug', $slug)->first();

        if ($apartment) {
            return response()->json(
                [
                    'success' => true,
                    'response' => $apartment,
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'response' => 'Sorry there is not your apartment',
                ]
            );
        }
    }


    public function searchApartments(Request $request)
    {

        $api_key = env('TOMTOM_API_KEY');
        $base_api = 'https://api.tomtom.com/search/2/geocode/';

        $address = str_replace(' ', '%20', $request['address']);

        // Add range distance dynamically from range input in FE
        $range_distance = $request->input('range_distance', 20);
        $services = $request->input('services', []);

        $rooms = $request->input('rooms');
        $beds = $request->input('beds');

        /* https://api.tomtom.com/search/2/geocode/Via%20degli%20anemoni%206%2000172%20Roma.json?storeResult=false&view=Unified&key=***** */
        //$api_url = $base_api.$address.'.json?storeResult=false&view=Unified&key='.$api_key;   
        $api_url = $base_api . $address . '.json?storeResult=false&countrySet=IT&view=Unified&key=' . $api_key;

        /* if request has address filled */
        if ($request->has('address') && $request['address'] != '') {

            /* call tomtom api and get results*/
            /* NB bypass ssl */
            $client = new Client(['verify' => false]);
            $result = json_decode($client->get($api_url)->getBody(), true)['results'][0];

            /* save coordinates */
            $coordinates = $result['position'];
            $latitude = $coordinates['lat'];
            $longitude = $coordinates['lon'];

            $earth_radius = 6371; //km

            //$range_radius = 20;  // $range_radius = 20;


            /* given lat and long to radians */
            $rad_lat = deg2rad($latitude);
            $rad_long = deg2rad($longitude);

            /* range_radius must be converted to radians before being converted to degrees */
            // $rad_radius = ($range_radius / $earth_radius);

            //use range_distance in order base on given range from user and calculate the radius
            $rad_radius = ($range_distance / $earth_radius);


            /* convert range radius to degrees */
            $deg_radius = rad2deg($rad_radius);

            /* limits (googled)*/
            $lat_min = ($latitude - $deg_radius);
            $lat_max = ($latitude + $deg_radius);
            $long_min = ($longitude - $deg_radius / cos($rad_lat));
            $long_max = ($longitude + $deg_radius / cos($rad_lat));

            /* $query = Apartment::query(); */
            /* $apartments = $query->whereBetween('latitude', [$lat_min, $lat_max])->whereBetween('longitude', [$long_min, [$long_max]])->with('services', 'sponsorships', 'user')->orderByDesc('id')->paginate(4); */


            /* QUERY BUILDER VERSION */
            /* try query builder to fetch apartments */
            /*  $query = DB::table('apartments')
                ->select('apartments.*')
                ->join('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
                ->join('services', 'apartment_service.service_id', '=', 'services.id')
                ->whereBetween('apartments.latitude', [$lat_min, $lat_max])
                ->whereBetween('apartments.longitude', [$long_min, $long_max]); */

            /* use subquery for each service */
            /* if there is at least one record */
            /*  foreach ($services as $service) {

                $query->whereExists(function ($subquery) use ($service) {
                    $subquery
                        ->from('apartment_service')
                        ->whereColumn('apartment_service.apartment_id', 'apartments.id')
                        ->where('apartment_service.service_id', $service);
                });
            } */

            /* order by distance from given address using haversine formula */
            /* $query->select([
                'apartments.*',
                DB::raw("(
                    2 * $earth_radius * ASIN (SQRT (POW (SIN((RADIANS($latitude - apartments.latitude)) / 2), 2) + COS (RADIANS($latitude)) * COS(RADIANS(apartments.latitude)) * POW(SIN ((RADIANS($longitude - apartments.longitude)) / 2), 2)
                ))) AS distance")
            ])
                ->orderBy('distance', 'asc');

            $apartments = $query->distinct()->paginate(10); */

            /* recap: I use query builder and apply filter for latitude and longitude. I check if user checked at least one service and, if he did, I use a subquery for each service selected: I verify the record existence and take the records where service_id = $service  */

            /* TRANSLATE IN ELOQUENT */
            $query = Apartment::whereBetween('latitude', [$lat_min, $lat_max])->whereBetween('longitude', [$long_min, $long_max]);

            //check for rooms and beds
            if (!empty($rooms)) {
                $query->where('rooms', '>=', $rooms);
            }
            if (!empty($beds)) {
                $query->where('beds', '>=', $beds);
            }

            foreach ($services as $service) {
                $query->whereHas('services', function ($subquery) use ($service) {
                    $subquery->where('service_id', $service);
                });
            }
            $apartments = $query->with(['services', 'sponsorships', 'user'])
                ->select([
                    'apartments.*',
                    DB::raw("(
                    2 * $earth_radius * ASIN (SQRT (POW (SIN((RADIANS($latitude - apartments.latitude)) / 2), 2) + COS (RADIANS($latitude)) * COS(RADIANS(apartments.latitude)) * POW(SIN ((RADIANS($longitude - apartments.longitude)) / 2), 2)
                ))) AS distance"),
                    DB::raw('IFNULL((SELECT COUNT(*) FROM apartment_sponsorship WHERE apartment_sponsorship.apartment_id = apartments.id), 0) AS is_sponsorship_active')
                ])
                ->orderByDesc('is_sponsorship_active')
                ->orderBy('distance', 'asc')
                ->distinct()
                ->paginate(10);


            return response()->json([
                'success' => true,
                'response' => $apartments,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Insert an address',
            ]);
        }
    }
}
