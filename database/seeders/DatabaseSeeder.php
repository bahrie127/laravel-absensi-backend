<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Bahri Admin',
            'email' => 'bahri@fic16.com',
            'password' => Hash::make('12345678'),
        ]);

        // data dummy for company
        \App\Models\Company::create([
            'name' => 'PT. FIC16',
            'email' => 'fic16@codewithbahri.com',
            'address' => 'Jl. Raya Kedung Turi No. 20, Sleman, DIY',
            'latitude' => '-7.747033',
            'longitude' => '110.355398',
            'radius_km' => '0.5',
            'time_in' => '08:00',
            'time_out' => '17:00',
        ]);

        $this->call([
            AttendanceSeeder::class,
        ]);
    }
}
