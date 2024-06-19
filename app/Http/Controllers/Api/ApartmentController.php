<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all()->where('user_id', auth()->id());
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }
}
