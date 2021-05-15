<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserRoleSeeder::class]);
        $this->call([DepartmentSeeder::class]);
        $this->call([DirektoratSeeder::class]);
        $this->call([DivisiSeeder::class]);
        $this->call([UnitSeeder::class]);
        $this->call([PenerimaanSeeder::class]);
        $this->call([UsersTableSeeder::class]);
    }
}
