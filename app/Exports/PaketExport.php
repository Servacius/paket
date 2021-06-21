<?php

namespace App\Exports;

use App\Models\Paket as ModelsPaket;
use App\Models\Penerimaan;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromArray;

class PaketExport implements FromArray
{
    protected $filter = [];

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return \Illuminate\Support\Arr
     */
    public function array(): array
    {
        $pakets = $this->fetchPaket($this->filter);
        $data[] = array('#', 'NIK', 'Nama', 'No. Telepon', 'Jenis Barang', 'Tanggal Sampai', 'Tanggal Diambil/Diantar', 'Cara Penerimaan');
        foreach ($pakets as $i => $paket) {
            $data[] = array(
                '#' => ($i + 1),
                'NIK' => $paket->nik_pemilik,
                'Nama' => $paket->nama_pemilik,
                'No. Telepon' => $paket->no_telepon,
                'Jenis Barang' => $paket->jenis_paket,
                'Tanggal Sampai' => $paket->tanggal_sampai,
                'Tanggal Diambil/Diantar' => $paket->tanggal_diambil,
                'Cara Penerimaan' => $paket->cara_penerimaan,
            );
        }
        return $data;
    }

    private function fetchPaket($filter)
    {
        $query = ModelsPaket::select(
            'id',
            'name',
            'nik_karyawan',
            'penerimaan_id',
            'jenis_barang',
            'tanggal_sampai',
            'tanggal_diambil',
            'picture',
            'catatan'
        );

        // Set filter by conditions.
        if (Arr::exists($filter, 'nik_karyawan')) {
            $query = $query->where('nik_karyawan', $filter['nik_karyawan']);
        }
        if (Arr::exists($filter, 'unpickedup') && $filter['unpickedup']) {
            $query = $query->whereNull('tanggal_diambil');
        }
        if (Arr::exists($filter, 'penerimaan') && $filter['penerimaan']) {
            $query = $query->whereNotNull('penerimaan_id')
                ->whereNull('tanggal_diambil');
        }

        // Order paket by 'tanggal_sampai' DESC.
        $pakets = $query->orderBy('tanggal_sampai', 'desc')
            ->get();

        // Collect and prevent duplicate ids of karyawan.
        $nikKaryawans = array();
        foreach ($pakets as $paket) {
            if (Arr::exists($nikKaryawans, $paket->nik_karyawan)) {
                continue;
            }

            $nikKaryawans[$paket->nik_karyawan] = true;
        }

        // Get data karyawan by nik list.
        $niks = array();
        foreach ($nikKaryawans as $nik => $exist) {
            array_push($niks, $nik);
        }
        $users = User::whereIn('nik', $niks)->get();

        $karyawans = array();
        foreach ($users as $user) {
            $karyawans[$user->nik] = $user;
        }

        $app = app();

        // Mapping paket and its user karyawan.
        $paketDetails = array();
        foreach ($pakets as $paket) {
            if ($karyawans[$paket->nik_karyawan] == null) {
                continue;
            }

            $paketDetail = $app->make('stdClass');
            $paketDetail->id = $paket->id;
            $paketDetail->nama_paket = $paket->name;
            $paketDetail->jenis_paket = $paket->jenis_barang;
            $paketDetail->nama_pemilik = $karyawans[$paket->nik_karyawan]->name;
            $paketDetail->nik_pemilik = $karyawans[$paket->nik_karyawan]->nik;
            $paketDetail->no_telepon = $karyawans[$paket->nik_karyawan]->no_telp;
            $paketDetail->gambar = $paket->picture;
            $paketDetail->tanggal_sampai = (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            $paketDetail->tanggal_pengantaran = "";
            $paketDetail->tanggal_diambil = "";
            $paketDetail->waktu_pengantaran = "";
            $paketDetail->cara_penerimaan = "";
            $paketDetail->telat_diambil = false;
            $paketDetail->telat_diantar = false;

            if ($paket->tanggal_diambil != null) {
                $paketDetail->tanggal_diambil = (new DateTime($paket->tanggal_diambil))->format('d-m-Y');
            }

            // Set 'cara_penerimaan' and status 'telat_diambil'.
            if ($paket->penerimaan_id > 0) {
                $penerimaan = Penerimaan::find($paket->penerimaan_id);

                $paketDetail->cara_penerimaan = ($penerimaan != null) ? $penerimaan->name : Penerimaan::PENERIMAAN_AMBIL_SENDIRI;
                if ($paketDetail->cara_penerimaan == Penerimaan::PENERIMAAN_DIANTAR && $penerimaan->catatan != null) {
                    $catatan = json_decode($penerimaan->catatan);

                    $paketDetail->tanggal_pengantaran = (new DateTime($catatan->tanggal_pengantaran))->format('d-m-Y');
                    $paketDetail->waktu_pengantaran = $catatan->waktu_pengantaran;
                }
            }

            $now = Carbon::createFromFormat('d-m-Y', date('d-m-Y'))->format('d-m-Y');
            switch ($paketDetail->cara_penerimaan) {
                case Penerimaan::PENERIMAAN_AMBIL_SENDIRI:
                    $paketDetail->telat_diambil = $now > $paketDetail->tanggal_sampai;
                    break;

                case Penerimaan::PENERIMAAN_DIANTAR:
                    $paketDetail->telat_diantar = $now > $paketDetail->tanggal_pengantaran;
                    break;

                default:
                    $paketDetail->telat_diambil = $now > $paketDetail->tanggal_sampai;
                    break;
            }

            array_push($paketDetails, $paketDetail);
        }

        if (Arr::exists($filter, 'nama')) {
            $resultFiltered = array();
            foreach ($paketDetails as $paketDetail) {
                if (str_contains(strtolower($paketDetail->nama_pemilik), strtolower($filter['nama']))) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_sampai_from')) {
            $resultFiltered = array();
            $from = (new DateTime($filter['tanggal_sampai_from']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_sampai >= $from) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_sampai_to')) {
            $resultFiltered = array();
            $to = (new DateTime($filter['tanggal_sampai_to']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_sampai  <= $to) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_diambil_from')) {
            $resultFiltered = array();
            $from = (new DateTime($filter['tanggal_diambil_from']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_diambil >= $from) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_diambil_to')) {
            $resultFiltered = array();
            $to = (new DateTime($filter['tanggal_diambil_to']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_diambil  <= $to) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }

        return $paketDetails;
    }
}
