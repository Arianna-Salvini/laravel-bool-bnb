<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{

    public function index()
    {
    }

    public function create(Apartment $apartment)
    {
        // User auth
        if ($apartment->user_id !== Auth::id()) {
            abort(403, 'This is not your apartment!');
        }

        $sponsorships = Sponsorship::all();

        return view('admin.sponsorships.create', compact('apartment'));
    }

    public function store()
    {
    }
}
