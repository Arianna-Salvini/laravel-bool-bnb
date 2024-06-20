<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

        /* https://api.tomtom.com/search/2/geocode/Via%20degli%20anemoni%206%2000172%20Roma.json?storeResult=false&view=Unified&key=***** */
        $api_url = $base_api.$address.'.json?storeResult=false&view=Unified&key='.$api_key;   


        /* if request has address filled */
        if ($request->has('address') && $request['address'] != '') {

            /* call tomtom api and get results*/
            /* NB bypass ssl */
            $client = new Client(['verify' => false]);
            $result = json_decode($client->get($api_url)->getBody(), true)['results'][0];

            /* if(isset($result['results'])){ */

                /* save coordinates */
                $coordinates = $result['position'];
                $latitude = $coordinates['lat'];
                $longitude = $coordinates['lon'];
    
                $earth_radius = 6371; //km
    
                $range_radius = 20;  // $range_radius = 20;
    
    
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
    
                $query = Apartment::query();
                $apartments = $query->whereBetween('latitude', [$lat_min, $lat_max])->whereBetween('longitude', [$long_min, [$long_max]])->with('services', 'sponsorships', 'user')->orderByDesc('id')->paginate(4);

                return response()->json([
                    'success' => true,
                    'response' => $apartments,
                ]);
            /* }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'No apartments found within the given range'
                ]);
            } */

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Insert an address',
            ]);
        }
    }
}
