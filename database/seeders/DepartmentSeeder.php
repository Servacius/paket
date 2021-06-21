<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('department')->truncate();

        DB::table('department')->insert([
            [
                'name' => 'Digital Product & Service Delivery 4',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Sales Digital Service Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Payment Digital Service Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Common Digital Service Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Business Enabler 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Common Digital Service Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Business Enabler 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'IT Business Enabler 2',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'Digital Product & Service Management',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'Employee & Industrial Relations',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'Learning & Talent Management',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'HC Technology & Reporting (109726)',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'Talent Acquisition Head (110355)',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'HCBP IT & Function (109729)',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'name' => 'Senior HCBP IT & Function (110306)',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
