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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard');
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
