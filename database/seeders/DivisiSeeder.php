<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisi')->insert([
            [   'name' => 'IT Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'IT Digital Service Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'IT Business Enablement',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'HC Strategy Development',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'HC Technology & Operations (109725)',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   'name' => 'HC Management IT & Functions (109732)',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
