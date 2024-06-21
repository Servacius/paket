<?php

namespace App\Http\Controllers;

use App\Models\Paket;
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
        if ($request->query('status') == 'not-taken') {
            return $this->indexNotTakenPaket();
        }

        return $this->indexUnpickedUpPaket();
    }

    /**
     * Display a listing of all paket.
     *
     * @return \Illuminate\View\View
     */
    public function indexAllPaket()
    {
        $pakets = Paket::orderBy('tanggal_sampai', 'desc')->get();

        return view('paket.index_all')->with(compact('pakets'));
    }

    /**
     * Display a listing of not taken paket.
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

        // Mapping paket and its user karyawan.
        $paketDetails = array();
        foreach ($pakets as $paket) {
            if ($karyawans[$paket->nik_karyawan] == null) {
                continue;
            }

            $paketDetail = array();
            $paketDetail["id"] = $paket->id;
            $paketDetail["nik_karyawan"] = $paket->nik_karyawan;
            $paketDetail["name_karyawan"] = $karyawans[$paket->nik_karyawan]->name;
            $paketDetail["name_paket"] = $paket->name;
            $paketDetail["no_telp"] = $karyawans[$paket->nik_karyawan]->no_telp;
            $paketDetail["tanggal_sampai"] = $paket->tanggal_sampai;
            $paketDetail["picture"] = $paket->picture;
            array_push($paketDetails, $paketDetail);
        }

        return view('paket.index_unpicked_up')->with(compact(['pakets' => $paketDetails]));
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
