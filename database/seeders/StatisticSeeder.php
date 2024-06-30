<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 600; $i++) {
            $ip_address = $this->randomIp();
            $date = $this->randomDate();

            $newView = new Statistic();
            $newView->ip_address = $ip_address;
            $newView->date = $date;
            $newView->apartment_id = rand(1, 21);
            $newView->created_at = $date;
            $newView->save();
        }
    }

    private function randomIp()
    {
        return mt_rand(1, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(1, 255);
    }

    private function randomDate()
    {
        $start_date = '2023-05-01 00:00:00';
        $end_date = '2024-06-29 23:59:59';
        $randomDateInGivenRange = mt_rand(strtotime($start_date), strtotime($end_date));
        return date('Y-m-d H:i:s', $randomDateInGivenRange);
    }
}
