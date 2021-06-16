<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    const STATUS_UNPICKED_UP = "unpickedup";

    /**
     * Table of Paket model.
     *
     * @var string
     */
    protected $table = 'paket';
}
