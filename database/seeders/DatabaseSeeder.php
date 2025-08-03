<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Ibrahim Khashaba',
        //     'email' => 'ibrahim@doctor.com',
        //     'password' => bcrypt('789789789'),
        // ]);

        Appointment::factory(20)->create();

        // $this->call(SymptomSeeder::class);
        // $this->call(DiseaseSeeder::class);
        // $this->call(DaysOffSeeder::class);
    }
}
