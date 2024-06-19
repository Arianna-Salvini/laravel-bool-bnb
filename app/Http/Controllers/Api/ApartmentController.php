<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'sponsorships')->orderByDesc('id')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }
}
