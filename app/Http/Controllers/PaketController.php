<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Direktorat;
use App\Models\Divisi;
use App\Models\Paket;
use App\Models\Penerimaan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Instantiate a new paket controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_karyawan');
    }

    /**
     * Display a listing of the paket.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->query('status') == 'unpickedup') {
            return $this->indexUnpickedUpPaket();
        }

        return $this->indexAllPaket();
    }

    /**
     * Display a listing of all paket.
     *
     * @return \Illuminate\View\View
     */
    public function indexAllPaket()
    {
        $pakets = Paket::orderBy('tanggal_sampai', 'desc')->get();

        return view('paket.index_all', [
            'pakets' => $pakets
        ]);
    }

    /**
     * Display a listing of unpicked up paket.
     *
     * @return \Illuminate\View\View
     */
    public function indexUnpickedUpPaket()
    {
        // Get data paket order by tanggal sampai DESC.
        $pakets = Paket::where('tanggal_diambil', null)
            ->orderBy('tanggal_sampai', 'desc')
            ->get();

        // Collect and prevent duplicate ids of karyawan.
        $karyawanIDs = array();
        foreach ($pakets as $paket) {
            if ($karyawanIDs[$paket->nik_karyawan]) {
                continue;
            }

            $karyawanIDs[$paket->nik_karyawan] = true;
        }

        // Get data user karyawan by ids.
        $niks = array();
        foreach ($karyawanIDs as $nik => $exist) {
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
            $paketDetail->nik_karyawan = $paket->nik_karyawan;
            $paketDetail->name_karyawan = $karyawans[$paket->nik_karyawan]->name;
            $paketDetail->name_paket = $paket->name;
            $paketDetail->no_telp = $karyawans[$paket->nik_karyawan]->no_telp;
            $paketDetail->tanggal_sampai = $paket->tanggal_sampai;
            $paketDetail->picture = $paket->picture;

            array_push($paketDetails, $paketDetail);
        }

        return view('paket.index_unpicked_up', [
            'pakets' => $paketDetails
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified paket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $paketDetail = $this->defaultPaketDetail();

        $paket = Paket::find($id);
        if ($paket != null) {
            $user = User::where('nik', $paket->nik_karyawan)->first();
            $direktorat = ($user->direktorat_id > 0) ? Direktorat::where($user->direktorat_id) : null;
            $divisi = ($user->divisi_id > 0) ? Divisi::where($user->divisi_id) : null;
            $department = ($user->department_id > 0) ? Department::where($user->department_id) : null;
            $unit = ($user->unit_id > 0) ? Unit::where($user->unit_id) : null;
            $penerimaan = ($paket->penerimaan_id > 0) ? Penerimaan::where($paket->penerimaan_id) : null;

            $paketDetail->id = $paket->id;
            $paketDetail->nik_penerima = $paket->nik_karyawan;
            $paketDetail->nama_penerima = $user->name;
            $paketDetail->email = $user->email;
            $paketDetail->telp = $user->no_telp;
            $paketDetail->direktorat = ($direktorat != null) ? $direktorat->name : "";
            $paketDetail->divisi = ($divisi != null) ? $divisi->name : "";
            $paketDetail->department = ($department != null) ? $department->name : "";
            $paketDetail->unit = ($unit != null) ? $unit->name : "";
            $paketDetail->jenis_barang = $paket->jenis_barang;
            $paketDetail->picture = $paket->picture;
            $paketDetail->barang_berbahaya = ($paket->barang_berbahaya == 1) ? "ya" : "tidak";
            $paketDetail->tanggal_sampai = (strtotime($paket->tanggal_sampai) <= 0 || strtotime($paket->tanggal_sampai) == false) ? "" : $paket->tanggal_sampai;
            $paketDetail->tanggal_ambil = (strtotime($paket->tanggal_diambil) <= 0 || strtotime($paket->tanggal_diambil) == false) ? "" : $paket->tanggal_diambil;
            $paketDetail->cara_penerimaan = ($penerimaan != null) ? $penerimaan->name : "";
        }

        return view('paket.detail', [
            'paketDetail' => $paketDetail
        ]);
    }

    private function defaultPaketDetail()
    {
        $app = app();
        $paketDetail = $app->make('stdClass');

        $paketDetail->id = "";
        $paketDetail->nik_penerima = "";
        $paketDetail->nama_penerima = "";
        $paketDetail->email = "";
        $paketDetail->telp = "";
        $paketDetail->direktorat = "";
        $paketDetail->divisi = "";
        $paketDetail->department = "";
        $paketDetail->unit = "";
        $paketDetail->jenis_barang = "";
        $paketDetail->barang_berbahaya = "";
        $paketDetail->picture = "";
        $paketDetail->tanggal_sampai = "";
        $paketDetail->tanggal_ambil = "";
        $paketDetail->cara_penerimaan = "";

        return $paketDetail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        dd();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
