<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $apartments = config('apartments');

        foreach ($apartments as $apartment) {
            $newApartment = new Apartment();
            $newApartment->title = $apartment['title'];
            $newApartment->slug = Str::slug($apartment['title'], '-');
            $newApartment->description = $apartment['description'];
            $newApartment->image = 'http://picsum.photos/300/200';
            $newApartment->rooms = $apartment['rooms'];
            $newApartment->beds = $apartment['beds'];
            $newApartment->bathrooms = $apartment['bathrooms'];
            $newApartment->square_meters = $apartment['square_meters'];
            $newApartment->address = $apartment['address'];
            $newApartment->street_number = $apartment['street_number'];
            $newApartment->country_code = $apartment['country_code'];
            $newApartment->city = $apartment['city'];
            $newApartment->zip_code = $apartment['zip_code'];
            $newApartment->latitude = $apartment['latitude'];
            $newApartment->longitude = $apartment['longitude'];
            $newApartment->visibility = $apartment['visibility'];
            $newApartment->save();
        }
    }
}
