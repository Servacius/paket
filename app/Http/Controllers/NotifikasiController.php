<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\UserRole;
use DateTime;

class NotifikasiController extends Controller
{
    /**
     * Fetch max 5 notifications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notifications()
    {
        $notifikasi = [];

        $pakets = Paket::select('id', 'tanggal_sampai');

        switch (auth()->user()->role_id) {
            case UserRole::ROLE_ID_KARYAWAN: // Notify karyawan if there is a new paket.
                $pakets = $pakets->where('nik_karyawan', auth()->user()->nik)
                    ->whereNull('tanggal_diambil')
                    ->whereNull('penerimaan_id');
                break;

            case UserRole::ROLE_ID_PETUGAS: // Notify petugas if karyawan have been confirm the way paket will be received.
                $pakets = $pakets->whereNull('tanggal_diambil')
                    ->whereNotNull('penerimaan_id');
                break;
        }

        $pakets = $pakets->orderByDesc('tanggal_sampai')
            ->limit(5)
            ->get();

        foreach ($pakets as $paket) {
            $paket->tanggal_sampai = (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            array_push($notifikasi, $paket);
        }

        return response()->json($notifikasi);
    }
}
