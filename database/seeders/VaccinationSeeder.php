<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'patient_name' => 'John Doe',
                'purok' => 'Purok 1',
                'vaccine' => 'BCG',
                'dose' => '1st dose',
                'scheduled_at' => '2026-11-03',
                'status' => 'Scheduled',
            ],
            [
                'patient_name' => 'Jane Doe',
                'purok' => 'Purok 2',
                'vaccine' => 'Pentavalent',
                'dose' => '2nd dose',
                'scheduled_at' => '2026-11-30',
                'status' => 'Scheduled',
            ],
            [
                'patient_name' => 'Genuine Doe',
                'purok' => 'Purok 3',
                'vaccine' => 'OPV',
                'dose' => '1st dose',
                'scheduled_at' => '2026-11-25',
                'status' => 'Scheduled',
            ],
            [
                'patient_name' => 'Ingenuine Doe',
                'purok' => 'Purok 4',
                'vaccine' => 'MMR',
                'dose' => '2nd dose',
                'scheduled_at' => '2026-10-31',
                'status' => 'Scheduled',
            ],
            [
                'patient_name' => 'Joe Schmoe',
                'purok' => 'Purok 5',
                'vaccine' => 'COVID-19',
                'dose' => '1st dose',
                'scheduled_at' => '2026-10-20',
                'status' => 'Overdue',
            ],
            [
                'patient_name' => 'Schmorgazbord Moe',
                'purok' => 'Purok 6',
                'vaccine' => 'Anti-Flu',
                'dose' => '2nd dose',
                'scheduled_at' => '2026-12-03',
                'status' => 'Scheduled',
            ],
            [
                'patient_name' => 'Darcy Graves',
                'purok' => 'Purok 7',
                'vaccine' => 'COVID-19',
                'dose' => 'Booster',
                'scheduled_at' => '2026-05-23',
                'status' => 'Done',
            ],
        ];

        foreach ($rows as $row) {
            Vaccination::create($row);
        }
    }
}
