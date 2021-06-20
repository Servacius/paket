<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Direktorat;
use App\Models\Divisi;
use App\Models\Paket;
use App\Models\Penerimaan;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
    }

    /**
     * Display a listing of the paket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (auth()->user()->cannot('view', Paket::class)) {
            abort(403);
        }

        if ($request->query('unpickedup')) {
            return $this->indexPaketUnpickedUp();
        } else if ($request->query('penerimaan')) {
            return $this->indexPaketPenerimaanConfirmed();
        }

        return $this->indexPaketAll();
    }

    /**
     * Display a listing of all paket.
     *
     * @return \Illuminate\View\View
     */
    public function indexPaketAll()
    {
        if (auth()->user()->cannot('viewAll', Paket::class)) {
            abort(403);
        }

        $pakets = $this->fetchPaket([]);

        return view('paket.index', [
            'pakets' => $pakets
        ]);
    }

    /**
     * Display a listing of all paket.
     *
     * @return \Illuminate\View\View
     */
    public function indexPaketPenerimaanConfirmed()
    {
        if (auth()->user()->cannot('viewFilterCaraPenerimaanConfirmed', Paket::class)) {
            abort(403);
        }

        $filter = ['penerimaan' => true];
        $pakets = $this->fetchPaket($filter);

        return view('paket.petugas.notifikasi', [
            'pakets' => $pakets
        ]);
    }

    /**
     * Display a listing of unpicked up paket.
     *
     * @return \Illuminate\View\View
     */
    public function indexPaketUnpickedUp()
    {
        if (auth()->user()->cannot('viewFilterUnpickedUp', Paket::class)) {
            abort(403);
        }

        $filter = [
            'nik_karyawan' => auth()->user()->nik,
            'unpickedup' => true
        ];
        $pakets = $this->fetchPaket($filter);

        return view('paket.karyawan.index_unpicked_up', [
            'pakets' => $pakets
        ]);
    }

    /**
     * Show the form for creating a new paket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->cannot('create', Paket::class)) {
            abort(403);
        }

        return view('paket.petugas.form_tambah_paket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->cannot('create', Paket::class)) {
            abort(403);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'required' => 'Gambar paket tidak boleh kosong.',
                'mimes' => 'Tipe gambar yang diperbolehkan: jpeg,png,jpg,gif,svg.',
                'max' => 'Ukuran gambar maksimal 2048kb.'
            ]
        );

        if ($validator->fails()) {
            // print_r($validator);
            // die();
            return redirect()
                ->route('paket.create')
                ->withErrors($validator);
        }

        $userPenerima = User::where('nik', $request->nik_penerima)->first();
        $userPetugas = User::where('nik', $request->nik_petugas)->first();

        $now = Carbon::now();

        $paket = new Paket();
        $paket->name = "Paket untuk: " . $userPenerima->name;
        $paket->nik_petugas = $userPetugas->nik;
        $paket->nik_karyawan = $userPenerima->nik;
        $paket->jenis_barang = $request->jenis_barang;
        $paket->barang_berbahaya = ($request->barang_berbahaya === 'ya') ? 1 : 0;
        $paket->tanggal_sampai = $now->toDateTimeString();
        $paket->tanggal_diambil = null;
        $paket->created_at = $now->toDateTimeString();
        $paket->updated_at = null;
        $paket->deleted_at = null;
        $paket->catatan = json_encode("");

        if ($request->telp != "") {
            $app = app();
            $catatan = $app->make('stdClass');
            $catatan->no_telepon = $request->telp;

            $request->catatan = json_encode($catatan);
        }

        if ($request->file('picture')) {
            $imagePath = $request->file('picture');
            $imageName = $imagePath->getClientOriginalName();
            $imageName = $userPenerima->nik . "-" . strtotime('now') . '-' . $imageName;

            // Store image to storage/images folder in public.
            $request->file('picture')->storeAs('images', $imageName, 'public');

            $paket->picture = $imageName;
        }

        $paket->save();

        return redirect()
            ->route('paket.index');
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
        if (auth()->user()->cannot('detail', Paket::class)) {
            abort(403);
        }

        $paketDetail = $this->getPaket($id);
        if ($paketDetail != null) {
            return view('paket.detail', [
                'paketDetail' => $paketDetail
            ]);
        }

        return redirect()
            ->route('paket.index')
            ->withErrors(['Paket dengan ID <strong class="font-weight-bold">' . $id . '</strong> tidak ditemukan.']);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  array  $filter
     * @return array  $paketDetails
     */
    private function fetchPaket($filter)
    {
        $query = Paket::select(
            'id',
            'name',
            'nik_karyawan',
            'penerimaan_id',
            'jenis_barang',
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

        // Order paket by 'tanggal_sampai' DESC.
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

        $app = app();

        // Mapping paket and its user karyawan.
        $paketDetails = array();
        foreach ($pakets as $paket) {
            if ($karyawans[$paket->nik_karyawan] == null) {
                continue;
            }

            $paketDetail = $app->make('stdClass');
            $paketDetail->id = $paket->id;
            $paketDetail->nama_paket = $paket->name;
            $paketDetail->jenis_paket = $paket->jenis_barang;
            $paketDetail->nama_pemilik = $karyawans[$paket->nik_karyawan]->name;
            $paketDetail->no_telepon = $karyawans[$paket->nik_karyawan]->no_telp;
            $paketDetail->gambar = $paket->picture;
            $paketDetail->tanggal_sampai = (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            $paketDetail->tanggal_pengantaran = "";
            $paketDetail->waktu_pengantaran = "";
            $paketDetail->cara_penerimaan = "";
            $paketDetail->telat_diambil = false;
            $paketDetail->telat_diantar = false;

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

        return $paketDetails;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return object $paketDetail
     */
    private function getPaket($id)
    {
        $paket = Paket::find($id);
        if ($paket != null) {
            $user = User::where('nik', $paket->nik_karyawan)->first();
            $direktorat = ($user->direktorat_id > 0) ? Direktorat::find($user->direktorat_id) : null;
            $divisi = ($user->divisi_id > 0) ? Divisi::find($user->divisi_id) : null;
            $department = ($user->department_id > 0) ? Department::find($user->department_id) : null;
            $unit = ($user->unit_id > 0) ? Unit::find($user->unit_id) : null;
            $penerimaan = ($paket->penerimaan_id > 0) ? Penerimaan::find($paket->penerimaan_id) : null;

            $app = app();
            $paketDetail = $app->make('stdClass');

            $paketDetail->id = $id;
            $paketDetail->nik_penerima = $paket->nik_karyawan;
            $paketDetail->nama_penerima = $user->name;
            $paketDetail->email = $user->email;
            $paketDetail->no_telepon = $user->no_telp;
            $paketDetail->direktorat = ($direktorat != null) ? $direktorat->name : "";
            $paketDetail->divisi = ($divisi != null) ? $divisi->name : "";
            $paketDetail->department = ($department != null) ? $department->name : "";
            $paketDetail->unit = ($unit != null) ? $unit->name : "";
            $paketDetail->jenis_paket = $paket->jenis_barang;
            $paketDetail->gambar = $paket->picture;
            $paketDetail->barang_berbahaya = ($paket->barang_berbahaya == 1) ? "ya" : "tidak";
            $paketDetail->tanggal_sampai = (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            $paketDetail->tanggal_diambil = ($paket->tanggal_diambil == null) ? "" : (new DateTime($paket->tanggal_diambil))->format('d-m-Y');
            $paketDetail->tanggal_diantar = "";
            $paketDetail->cara_penerimaan = "";

            if ($penerimaan != null) {
                $paketDetail->cara_penerimaan = (new Penerimaan())->getPenerimaanText($penerimaan->name);

                if ($paketDetail->cara_penerimaan == Penerimaan::PENERIMAAN_AMBIL_SENDIRI_TEXT) {
                    $paketDetail->tanggal_diantar = (new DateTime($paket->tanggal_pengantaran))->format('d-m-Y');
                }
            }

            // There are 2 column store phone number: in column 'catatan' table Paket and column 'no_telp' table User.
            // Default value is from column 'no_telp' table User. But if value in column 'catatan' table Paket exist, it
            // will be replaced.
            if ($paket->catatan != null) {
                $catatan = json_decode($paket->catatan);
                if (property_exists($catatan, 'no_telepon')) {
                    $paketDetail->no_telepon = $catatan->no_telepon;
                }
            }

            return $paketDetail;
        }

        return null;
    }
}
