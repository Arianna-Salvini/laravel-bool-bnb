<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Marco',
                'lastname' => 'Barletta',
                'email' => 'marco.barletta@example.com',
                'birth_date' => '1990-01-01',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Maria',
                'lastname' => 'Rossastra',
                'email' => 'maria.rossastra@gmail.com',
                'birth_date' => '1995-09-05',
                'password' => Hash::make('Ciao123?'),
            ],
            [
                'name' => 'Arianna',
                'lastname' => 'Salvini',
                'email' => 'arianna.salvini@gmail.com',
                'birth_date' => '1993-06-21',
                'password' => Hash::make('Ciao123?'),
            ],
        ];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->lastname = $user['lastname'];
            $newUser->email = $user['email'];
            $newUser->birth_date = $user['birth_date'];
            $newUser->password = $user['password'];
            $newUser->save();
        }
    }
}
