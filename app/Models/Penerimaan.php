<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    const PENERIMAAN_AMBIL_SENDIRI = "ambil_sendiri";
    const PENERIMAAN_DIANTAR = "diantar";

    /**
     * Table of Penerimaan model.
     *
     * @var string
     */
    protected $table = 'penerimaan';
}
