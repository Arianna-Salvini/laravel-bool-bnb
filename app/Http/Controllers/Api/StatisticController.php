<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->has('ip_address'));
        $ip_address = $request->input('ip_address');
        //$apartment_id = $request->input('apartment_id');

        /* check if there is a view for that ip */
        //$alreadyPresentView = Statistic::where('apartment_id', $apartment_id)->where('ip_address', $ip_address)->whereDate('date', $today);

        /* if there is a view, do nothing. If there isnt a view, save it */
        /* if(!$alreadyPresentView){
            Statistic::create([
                'apartment_id' => $apartment_id,
                'ip_address' => $ip_address,
                'date' => $today
            ]);
        } */

        return response()->json([
            'success' => true,
            'data' => $ip_address
        ]);
        //dd($request);
    }
}
