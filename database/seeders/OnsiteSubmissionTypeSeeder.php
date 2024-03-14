<?php

namespace Database\Seeders;

use App\Models\OnsiteSubmissionType;
use Illuminate\Database\Seeder;

class OnsiteSubmissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submissionTypes = [['name' => 'Cash','payment_type_id' => 2],
            ['name' => 'Online','payment_type_id' => 2]

        ];
        foreach ($submissionTypes as $submissionType) {
            OnsiteSubmissionType::create($submissionType);
        }

    }
}
