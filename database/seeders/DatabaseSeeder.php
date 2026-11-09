<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Paul',
            'email' => 'nurse.yuson@bakuna.test',
            'password' => 'bakuna2026',
        ]);

        $this->call(VaccinationSeeder::class);
    }
}
