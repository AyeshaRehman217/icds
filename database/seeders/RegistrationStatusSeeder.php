<?php

namespace Database\Seeders;

use App\Models\RegistrationStatus;
use Illuminate\Database\Seeder;

class RegistrationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrationStatuses = [['name' => 'Pending', 'slug' => 'pending'],
            ['name' => 'Approved', 'slug' => 'approved'],
            ['name' => 'Rejected', 'slug' => 'rejected']
        ];
        foreach ($registrationStatuses as $registrationStatus) {
            RegistrationStatus::create($registrationStatus);
        }

    }
}
