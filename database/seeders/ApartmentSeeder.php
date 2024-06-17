<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $apartment = new Apartment(); // temporaly use of faker, valuating possibility of external libraries for apartments generator
            $apartment->title = $faker->sentence(10);
            $apartment->slug = Str::slug($apartment->title, '-');
            $apartment->description = $faker->text(250);
            $apartment->image = $faker->imageUrl(300, 200, 'Apartments', true, $apartment->title, false, 'jpg');
            $apartment->rooms = $faker->numberBetween(1, 6);
            $apartment->beds = $faker->numberBetween(1, 6);
            $apartment->bathrooms = $faker->numberBetween(1, 2);
            $apartment->square_meters = $faker->numberBetween(40, 250);
            $apartment->address = $faker->address();
            $apartment->street_number = $faker->randomNumber(3);
            $apartment->country_code = $faker->countryCode();
            $apartment->city = $faker->city();
            $apartment->zip_code = $faker->postcode();
            $apartment->latitude = $faker->latitude(-90, 90);
            $apartment->longitude = $faker->longitude(-180, 180);
            $apartment->visibility = $faker->boolean(75);
            $apartment->save();
        }
    }
}
