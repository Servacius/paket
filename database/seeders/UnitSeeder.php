<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit')->insert([
            [   
                'name' => 'Digital Application Solutions 4',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Digital Quality Engineering 5',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Technical Lead Digital Product Service Delivery 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'SQA Digital Product & Dervice Delivery 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'IT Solution Architect Banking Asset',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Developer Digital Product & Service Delivery 5',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Digital Application Solution Technical Lead 4',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Technical Lead Digital Product & Service Delivery 2',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Senior IT Business Enabler 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'IT Business Enabler 1 Unit',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Senior IT Business Enabler 2',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'IT Business Enabler 2 Unit',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Senior Product Owner',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Product Owner',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Senior Scrum Master',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Scrum Master',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Change Management',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Unit Employee & Industrial Relations',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Talent Management',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Corporate Acceleration Program',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Unit HC Technology & Reporting',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Outsourcing Management',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [   
                'name' => 'Talent Acquisition',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
