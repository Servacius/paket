<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    const PENERIMAAN_AMBIL_SENDIRI = "ambil_sendiri";
    const PENERIMAAN_DIANTAR = "diantar";

    const PENERIMAAN_AMBIL_SENDIRI_TEXT = "Ambil Sendiri";
    const PENERIMAAN_DIANTAR_TEXT = "Diantar";

    private $penerimaanText = [
        self::PENERIMAAN_AMBIL_SENDIRI => self::PENERIMAAN_AMBIL_SENDIRI_TEXT,
        self::PENERIMAAN_DIANTAR => self::PENERIMAAN_DIANTAR_TEXT
    ];

    public function getPenerimaanText($penerimaanID)
    {
        return $this->penerimaanText[$penerimaanID];
    }

    /**
     * Table of Penerimaan model.
     *
     * @var string
     */
    protected $table = 'penerimaan';
}
