<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'User Management',
                'slug' => 'user-management'
            ],
            [
                'name' => 'Backup',
                'slug' => 'backup'
            ],
            [
                'name' => 'Master Data',
                'slug' => 'master-data'
            ],
            [
                'name' => 'Demographic Data',
                'slug' => 'demographic-data'
            ],
            [
                'name' => 'Registration',
                'slug' => 'registration'
            ]
        ];
        foreach ($groups as $group){
            PermissionGroup::create($group);
        }
    }
}
