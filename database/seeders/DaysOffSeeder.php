<?php

namespace Database\Seeders;

use App\Models\DaysOff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysOffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $daysOffs = [
            ['en' => 'Saturday', 'ar' => 'السبت'],
            ['en' => 'Friday', 'ar' => 'الجمعة'],
        ];

        foreach ($daysOffs as $daysOff) {
            DaysOff::create([
                'day' => $daysOff,
            ]);
        }
    }
}
