<?php

namespace App\Http\Controllers;

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
        if (auth()->user()->role_id == 1) {
            return redirect()->route('admin.home');
        } elseif (auth()->user()->role_id == 2) {
            return redirect()->route('karyawan.home');
        } elseif (auth()->user()->role_id == 3) {
            return redirect()->route('petugas.home');
        }

        return redirect()->route('login')
            ->with('error', 'Pasangan email dan password salah. Silahkan coba lagi.');
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
     * Show the application petugas dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function petugasHome()
    {
        return view('pages.petugasHome');
    }

    /**
     * Show the application karyawan dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function karyawanHome()
    {
        return view('pages.karyawanHome');
    }
}
