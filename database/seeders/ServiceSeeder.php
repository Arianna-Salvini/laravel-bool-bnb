<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Wifi',
            'Pool',
            'Parking spot',
            'Concierge',
            'Sauna',
            'Sea view',
            'Air conditioning',
            'Garden',
            'Garage',
            'Elevator',
            'Furnished',
            'TV',
            'Pet Friendly',
            'Wheelchair accessible',
            'Smokers allowed',
            'Bath tub',
            'Shower',
            'Balcony',
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->service_name = $service;
            $newService->save();
        }
    }
}
