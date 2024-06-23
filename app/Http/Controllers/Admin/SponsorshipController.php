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

    public function store(Apartment $apartment, Request $request)
    {
        // User auth
        //dd($_POST);
        if ($apartment->user_id !== Auth::id()) {
            abort(403, 'This is not your apartment!');
        }

        $gateway = new Gateway(config('braintree'));

        $sponsorship_id = $request->input('sponsorship');
        $sponsorship = Sponsorship::findOrFail($sponsorship_id);

        $nonceFromTheClient = $request->input('payment_method_nonce');
        //dd($nonceFromTheClient);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        //dd($result);

        if ($result->success) {

            /* What if I already have sponsorships active on this apartment? 
            -get currentSponsorship from relationship table and order expiration date by desc
            -if there is a current sponsorship active, calc the new expiration date: exp date + hours
            -otherwise calc normal exp date
            -update the attachment
            */


            /* save sponsorship */

            /* I have to pass start date and expiration date */
            $apartment->sponsorships()->attach(
                $sponsorship_id,
                [
                    'start_date' => now(),
                    'expiration_date' => now()->addHours($sponsorship->duration)
                ]
            );

            return to_route('admin.apartments.show', $apartment)->with('message', "Sponsorship $sponsorship->name purchased successfully");
        } else {
            /* give error in payment message */
            //dd($result->errors->deepAll());
            return to_route('admin.apartments.show', $apartment)->with('error', "Error processing payment");
        }
    }
}
