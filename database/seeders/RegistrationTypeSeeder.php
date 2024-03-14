<?php

namespace Database\Seeders;

use App\Models\RegistrationType;
use Illuminate\Database\Seeder;

class RegistrationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrationTypes = [['name' => 'Student', 'amount' => '3000','dollar_amount' =>'50'],
            ['name' => 'Faculty', 'amount' => '4000','dollar_amount'=>'100'],
        ];
        foreach ($registrationTypes as $registrationType) {
            RegistrationType::create($registrationType);
        }

    }
}
