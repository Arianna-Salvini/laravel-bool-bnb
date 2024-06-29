<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeder
     */
    public function run(): void
    {
        $apartments = config('apartments');

        foreach ($apartments as $apartment) {
            $newApartment = new Apartment();
            $newApartment->user_id = $apartment['user_id'];
            $newApartment->title = $apartment['title'];
            $newApartment->slug = Str::slug($apartment['title'], '-');
            $newApartment->description = $apartment['description'];
            $newApartment->image = $apartment['image'];
            $newApartment->rooms = $apartment['rooms'];
            $newApartment->beds = $apartment['beds'];
            $newApartment->bathrooms = $apartment['bathrooms'];
            $newApartment->square_meters = $apartment['square_meters'];
            $newApartment->address = $apartment['address'];
            /* $newApartment->street_number = $apartment['street_number'];
            $newApartment->country_code = $apartment['country_code'];
            $newApartment->city = $apartment['city'];
            $newApartment->zip_code = $apartment['zip_code']; */
            $newApartment->latitude = $apartment['latitude'];
            $newApartment->longitude = $apartment['longitude'];
            $newApartment->visibility = $apartment['visibility'];
            $newApartment->save();

            if (isset($apartment['services'])) {
                foreach ($apartment['services'] as $serviceData) {
                    $service = Service::firstOrCreate([
                        'service_name' => $serviceData['service_name']
                    ]);
                    $newApartment->services()->attach($service->id);
                }
            }

            if (isset($apartment['sponsorships'])) {
                foreach ($apartment['sponsorships'] as $sponsorshipData) {
                    $sponsorship = Sponsorship::firstOrCreate([
                        'name' => $sponsorshipData['name'],
                        'duration' => $sponsorshipData['duration'],
                        'price' => $sponsorshipData['price']
                    ]);

                    $start_date = Carbon::now();
                    $expiration_date = $start_date->copy()->addHours($sponsorshipData['duration']);

                    $newApartment->sponsorships()->attach($sponsorship->id, [
                        'start_date' => $start_date,
                        'expiration_date' => $expiration_date
                    ]);
                }
            }

            // if (isset($apartment['sponsorships'])) {
            //     foreach ($apartment['sponsorships'] as $sponsorshipData) {
            //         $sponsor = Sponsorship::firstOrCreate([
            //             'name' => $sponsorshipData['name'],
            //             'duration' => $sponsorshipData['duration'] ?? 24,
            //             'price' => $sponsorshipData['price'] ?? 2.99,
            //             'start_date' => $sponsorshipData['start_date'],
            //             'expiration_date' => $sponsorshipData['expiration_date'],
            //         ]);
            //         $newApartment->sponsorships()->attach($sponsor->id);
            //     }
            // }
        }
    }
}
