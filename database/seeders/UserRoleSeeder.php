<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
            [   'name' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'Karyawan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [    'name' => 'Petugas',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
