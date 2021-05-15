<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirektoratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('direktorat')->insert([
            [    'name' => 'Teknologi Informasi',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [    'name' => 'Human Capital',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
