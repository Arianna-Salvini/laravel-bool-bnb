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
        $apartments = Apartment::with('services', 'sponsorships', 'user')->orderByDesc('id')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    public function searchApartments(Request $request){

        $api_key= env('TOMTOM_API_KEY');
        $base_api= 'https://api.tomtom.com/search/2/geocode/';
        
        $address= str_replace(' ', '%20', $request['address']);

        /* https://api.tomtom.com/search/2/geocode/Via%20degli%20anemoni%206%2000172%20Roma.json?storeResult=false&view=Unified&key=***** */
        $api_url = $base_api . $address . '.json?storeResult=false&view=Unified&key=' . $api_key;        

        /* if request has address filled */
        if($request->has('address') && $request['address'] != ''){

            /* call tomtom api and get results*/
            /* NB bypass ssl */
            $client = new Client(['verify' => false]);
            $result = json_decode($client->get($api_url)->getBody(), true)['results'][0];

            /* save coordinates */
            $coordinates = $result['position'];
            $latitude = $coordinates['lat'];
            $longitude = $coordinates['lon'];


            /* haversine formula? */
            $earth_radius= 6371; //km
            $range_radius= 20;
    
            /* haversine formula:
                d= 2r ⋅ arcsin(sqrt (sin^2(Δlat/2) + cos(lat1) ⋅ cos(lat2) ⋅ sin^2(Δlong/2) ))
                where d=distance between 2 points
                r= earth radius in km
                Δlat = lat2 - lat1
                Δlong = long2 - long1
                lat and long must be in RADIANS
    
                use arccos to compact formula: 
                d= r ⋅ arccos( cos(lat1) ⋅ cos(lat2) ⋅ cos(Δlong) + sin(lat1) ⋅ sin(lat2) )
    
                calculates the distance between 2 points
    
                I need to filter apartments inside a given radius from a point, given lat and long of that point
            */       
    
            /* given lat and long to radians */
            $rad_lat=deg2rad($latitude);
            $rad_long=deg2rad($longitude);
    
            /* range_radius must be converted to radians before being converted to degrees */
            $rad_radius= ($range_radius / $earth_radius);
            /* convert to degrees */
            $deg_radius= rad2deg($rad_radius);
    
            /* limits */
            $lat_min= ($latitude - $deg_radius);
            $lat_max= ($latitude + $deg_radius);
            $long_min= ($longitude - $deg_radius / cos($rad_lat));
            $long_max= ($longitude + $deg_radius / cos($rad_lat));

            $query = Apartment::query();
            $apartments = $query->whereBetween('latitude', [$lat_min, $lat_max])->whereBetween('longitude', [$long_min, [$long_max]])->with('services', 'sponsorships', 'user')->orderByDesc('id')->paginate(4);
                                
    
            return response()->json([
                'success' => true,
                'response' => $apartments
            ]);
        }

    }
}
