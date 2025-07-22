<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
     public function run()
    {
        $diseases = [
            ['en' => 'Diabetes', 'ar' => 'داء السكري'],
            ['en' => 'Hypertension', 'ar' => 'ارتفاع ضغط الدم'],
            ['en' => 'Asthma', 'ar' => 'الربو'],
            ['en' => 'Heart Disease', 'ar' => 'أمراض القلب'],
            ['en' => 'Cancer', 'ar' => 'السرطان'],
        ];

        foreach ($diseases as $disease) {
            Disease::create([
                'name' => $disease,
            ]);
        }
    }
}
