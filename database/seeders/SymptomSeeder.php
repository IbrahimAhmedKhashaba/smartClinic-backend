<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    public function run()
    {
        $symptoms = [
            ['en' => 'Headache', 'ar' => 'صداع'],
            ['en' => 'Fever', 'ar' => 'حمى'],
            ['en' => 'Cough', 'ar' => 'سعال'],
            ['en' => 'Fatigue', 'ar' => 'إرهاق'],
            ['en' => 'Nausea', 'ar' => 'غثيان'],
        ];

        foreach ($symptoms as $symptom) {
            Symptom::create([
                'name' => $symptom,
            ]);
        }
    }
}
