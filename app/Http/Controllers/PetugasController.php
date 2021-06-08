<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function add()
    {
        return view('petugas.add');
    }

    public function addBarang(Request $request)
    {
        dd($request);
    }
}
