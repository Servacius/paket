<?php

namespace App\Http\Controllers;

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
                return view('karyawan.index');

            case UserRole::ROLE_ID_PETUGAS:
                return view('petugas.index');
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
}
