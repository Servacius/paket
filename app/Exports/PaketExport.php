<?php

namespace App\Exports;

use App\Models\Department;
use App\Models\Direktorat;
use App\Models\Divisi;
use App\Models\Paket as ModelsPaket;
use App\Models\Penerimaan;
use App\Models\Unit;
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
        $data[] = array('No.', 'NIK', 'Nama', 'No. Telepon', 'Email', 'Direktorat', 'Divisi', 'Departemen', 'Unit', 'Jenis Barang', 'Barang Berbahaya', 'Tanggal Sampai', 'Tanggal Diambil/Diantar', 'Cara Penerimaan');
        foreach ($pakets as $i => $paket) {
            $data[] = array(
                'No.' => ($i + 1),
                'NIK' => $paket->nik_pemilik,
                'Nama' => $paket->nama_pemilik,
                'No. Telepon' => $paket->no_telepon,
                'Email' => $paket->email,
                'Direktorat' => $paket->direktorat,
                'Divisi' => $paket->divisi,
                'Departemen' => $paket->department,
                'Unit' => $paket->unit,
                'Jenis Barang' => $paket->jenis_paket,
                'Barang Berbahaya' => $paket->barang_berbahaya,
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
            'barang_berbahaya',
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

        // Fetch and order paket by 'tanggal_sampai' DESC.
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

        $direktorats = $this->fetchDirektoratData();
        $departments = $this->fetchDepartmentData();
        $divisies = $this->fetchDivisiData();
        $units = $this->fetchUnitData();

        $app = app();

        // Mapping paket and its user karyawan.
        $paketDetails = array();
        foreach ($pakets as $paket) {
            if ($karyawans[$paket->nik_karyawan] == null) {
                continue;
            }

            $karyawanPemilik = $karyawans[$paket->nik_karyawan];

            $paketDetail = $app->make('stdClass');
            $paketDetail->id = $paket->id;
            $paketDetail->nama_paket = $paket->name;
            $paketDetail->jenis_paket = $paket->jenis_barang;
            $paketDetail->barang_berbahaya = ($paket->barang_berbahaya == 1) ? "Ya" : "Tidak";
            $paketDetail->nama_pemilik = $karyawanPemilik->name;
            $paketDetail->nik_pemilik = $karyawanPemilik->nik;
            $paketDetail->no_telepon = $karyawanPemilik->no_telp;
            $paketDetail->email = $karyawanPemilik->email;
            $paketDetail->gambar = $paket->picture;
            $paketDetail->tanggal_sampai = (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            $paketDetail->tanggal_pengantaran = "";
            $paketDetail->tanggal_diambil = "";
            $paketDetail->waktu_pengantaran = "";
            $paketDetail->cara_penerimaan = "";
            $paketDetail->telat_diambil = false;
            $paketDetail->telat_diantar = false;

            $paketDetail->direktorat = "";
            if ($karyawanPemilik->direktorat_id != null) {
                $paketDetail->direktorat = $direktorats[$karyawanPemilik->direktorat_id]->name;
            }
            $paketDetail->department = "";
            if ($karyawanPemilik->department_id != null) {
                $paketDetail->department = $departments[$karyawanPemilik->department_id]->name;
            }
            $paketDetail->divisi = "";
            if ($karyawanPemilik->divisi_id != null) {
                $paketDetail->divisi = $divisies[$karyawanPemilik->divisi_id]->name;
            }
            $paketDetail->unit = "";
            if ($karyawanPemilik->unit_id != null) {
                $paketDetail->unit = $units[$karyawanPemilik->unit_id]->name;
            }

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

        $paketDetails = $this->cleanDataPaketByFilter($paketDetails, $filter);

        return $paketDetails;
    }

    private function cleanDataPaketByFilter($paketDetails, $filter)
    {
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
                if ($paketDetail->tanggal_sampai != "" && $paketDetail->tanggal_sampai >= $from) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_sampai_to')) {
            $resultFiltered = array();
            $to = (new DateTime($filter['tanggal_sampai_to']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_sampai != "" && $paketDetail->tanggal_sampai  <= $to) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_diambil_from')) {
            $resultFiltered = array();
            $from = (new DateTime($filter['tanggal_diambil_from']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                $date = $paketDetail->tanggal_diambil;
                if ($paketDetail->cara_penerimaan == Penerimaan::PENERIMAAN_DIANTAR) {
                    $date = $paketDetail->tanggal_pengantaran;
                }

                if ($date != "" && $date >= $from) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_diambil_to')) {
            $resultFiltered = array();
            $to = (new DateTime($filter['tanggal_diambil_to']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                $date = $paketDetail->tanggal_diambil;
                if ($paketDetail->cara_penerimaan == Penerimaan::PENERIMAAN_DIANTAR) {
                    $date = $paketDetail->tanggal_pengantaran;
                }

                if ($date != "" && $date  <= $to) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }

        return $paketDetails;
    }

    private function fetchUnitData()
    {
        $data = Unit::all();

        $units = array();
        foreach ($data as $d) {
            $units[$d->id] = $d;
        }

        return $units;
    }

    private function fetchDirektoratData()
    {
        $data = Direktorat::all();

        $direktorats = array();
        foreach ($data as $d) {
            $direktorats[$d->id] = $d;
        }

        return $direktorats;
    }

    private function fetchDepartmentData()
    {
        $data = Department::all();

        $departments = array();
        foreach ($data as $d) {
            $departments[$d->id] = $d;
        }

        return $departments;
    }

    private function fetchDivisiData()
    {
        $data = Divisi::all();

        $divisies = array();
        foreach ($data as $d) {
            $divisies[$d->id] = $d;
        }

        return $divisies;
    }
}
