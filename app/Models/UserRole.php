<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    // List of user role.
    const ADMINISTRATOR = 'administrator';
    const KARYAWAN = 'karyawan';
    const PETUGAS = 'petugas';

    // List of user role id.
    const ROLE_ID_ADMINISTRATOR = 1;
    const ROLE_ID_KARYAWAN = 2;
    const ROLE_ID_PETUGAS = 3;

    private $role = [
        self::ROLE_ID_ADMINISTRATOR => self::ADMINISTRATOR,
        self::ROLE_ID_KARYAWAN => self::KARYAWAN,
        self::ROLE_ID_PETUGAS => self::PETUGAS
    ];

    public function getRole($roleID)
    {
        return $this->role[$roleID];
    }

    /**
     * Table of UserRole model.
     *
     * @var string
     */
    protected $table = 'user_role';
}
