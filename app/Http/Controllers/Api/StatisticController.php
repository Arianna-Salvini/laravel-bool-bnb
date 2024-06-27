<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->has('ip_address'));
        $ip_address = $request->query('ip_address');

        return response()->json([
            'success' => true,
            'data' => $ip_address
        ]);
        //dd($request);
    }
}
