<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'nik' => 'A001',
                'password' => Hash::make('secret'),
                'role_id' => 1,
                'name' => 'Admin Admin',
                'email' => 'admin@paper.com',
                'no_telp' => '08111999119',
                'direktorat_id' => 1,
                'divisi_id' => 1,
                'department_id' => 1,
                'unit_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ],
            [
                'id' => 2,
                'nik' => 'K001',
                'password' => Hash::make('secret'),
                'role_id' => 2,
                'name' => 'Daniel Manullang',
                'email' => 'daniel@paket.com',
                'no_telp' => '081122999119',
                'direktorat_id' => 2,
                'divisi_id' => 2,
                'department_id' => 2,
                'unit_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
            ,
            [
                'id' => 3,
                'nik' => 'P001',
                'password' => Hash::make('secret'),
                'role_id' => 3,
                'name' => 'Udin Kong',
                'email' => 'udingkong@paket.com',
                'no_telp' => '08112442219',
                'direktorat_id' => NULL,
                'divisi_id' => NULL,
                'department_id' => NULL,
                'unit_id' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL
            ]
        ]);
    }
}
