<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Penerimaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    /**
     * Instantiate a new penerimaan controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Prevent to store null.
        $catatan = json_encode("");
        if ($request->cara_penerimaan === Penerimaan::PENERIMAAN_DIANTAR) {
            $app = app();
            $detailPenerimaan = $app->make('stdClass');
            $detailPenerimaan->tanggal_pengantaran = $request->tanggal_pengantaran;
            $detailPenerimaan->waktu_pengantaran = $request->waktu_pengantaran;
            $detailPenerimaan->lantai = $request->lantai;
            $detailPenerimaan->keterangan = $request->keterangan;

            $catatan = json_encode($detailPenerimaan);
        }

        $now = Carbon::now();

        // Store new penerimaan record.
        $penerimaan = new Penerimaan();
        $penerimaan->name = $request->cara_penerimaan;
        $penerimaan->catatan = $catatan;
        $penerimaan->created_at = $now->toDateTimeString();
        $penerimaan->updated_at = null;
        $penerimaan->deleted_at = null;
        $penerimaan->save();
        $lastInsertID = $penerimaan->id;

        // Update paket record.
        Paket::where('id', $request->paket_id)
            ->update(['penerimaan_id' => $lastInsertID]);

        return redirect()
            ->route('paket.detail', ['id' => $request->paket_id]);
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
