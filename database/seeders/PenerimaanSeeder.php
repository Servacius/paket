<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penerimaan')->insert([
            [   'name' => 'Ambil Sendiri',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'Diantar',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
