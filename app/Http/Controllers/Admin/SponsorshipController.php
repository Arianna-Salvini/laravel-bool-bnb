<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Braintree\Gateway;
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

        /* generate the client token for client auth and send it to client */
        $gateway = new Gateway(config('braintree'));
        $clientToken = $gateway->clientToken()->generate();

        return view('admin.sponsorships.create', compact('apartment', 'sponsorships', 'clientToken'));
    }

    public function store()
    {
    }
}
