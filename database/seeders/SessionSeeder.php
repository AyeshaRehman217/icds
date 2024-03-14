<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessions = [['name' => 'Session 2021','year'=>'2021'],
            ['name' => 'Session 2022','year'=>'2022'],
            ['name' => 'Session 2023','year'=>'2023']
        ];
        foreach ($sessions as $session) {
            Session::create($session);
        }

    }
}
