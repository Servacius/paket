<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\UserRole;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function index()
    {
        switch (auth()->user()->role_id) {
            case UserRole::ROLE_ID_ADMINISTRATOR:
                return view('admin.home');

            case UserRole::ROLE_ID_KARYAWAN:
                $dataPaket = $this->getDataPaket(UserRole::ROLE_ID_KARYAWAN);
                return view('karyawan.index', ['dataPaket' => $dataPaket]);

            case UserRole::ROLE_ID_PETUGAS:
                $dataPaket = $this->getDataPaket(UserRole::ROLE_ID_PETUGAS);
                return view('petugas.index', ['dataPaket' => $dataPaket]);
        }

        return redirect()
            ->route('login')
            ->withErrors(['Pasangan email dan password salah. Silahkan coba lagi.']);
    }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminHome()
    {
        // dd("nyampe cuk");
        return view('pages.adminHome');
    }

    /**
     * Get data paket.
     *
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */
    private function getDataPaket($role)
    {
        $app = app();
        $dataPaket = $app->make('stdClass');
        $dataPaket->count_all = 0;
        $dataPaket->count_all_pickedup = 0;
        $dataPaket->count_user = 0;
        $dataPaket->count_user_pickedup = 0;
        $dataPaket->count_all_notifikasi = 0;

        switch ($role) {
            case UserRole::ROLE_ID_KARYAWAN:
                $allPaket = Paket::all()->count();
                $allPaketPickedup = Paket::whereNotNull('tanggal_diambil')->count();

                $userPaket = Paket::where('nik_karyawan', auth()->user()->nik)->count();
                $userPaketPickedup = Paket::where('nik_karyawan', auth()->user()->nik)->whereNotNull('tanggal_diambil')->count();

                $dataPaket->count_all = $allPaket;
                $dataPaket->count_all_pickedup = $allPaketPickedup;
                $dataPaket->count_user = $userPaket;
                $dataPaket->count_user_pickedup = $userPaketPickedup;
                // die();

                break;

            case UserRole::ROLE_ID_PETUGAS:
                $allPaket = Paket::all()->count();
                $allPaketPickedup = Paket::whereNotNull('tanggal_diambil')->count();
                $allConfirmedCaraPenerimaan = Paket::whereNotNull('penerimaan_id')->count();

                $dataPaket->count_all = $allPaket;
                $dataPaket->count_all_pickedup = $allPaketPickedup;
                $dataPaket->count_all_notifikasi = $allConfirmedCaraPenerimaan;

                break;

            default:
                # code...
                break;
        }

        return $dataPaket;
    }
}
