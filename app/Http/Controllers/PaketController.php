<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Direktorat;
use App\Models\Divisi;
use App\Models\Paket;
use App\Models\Penerimaan;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use DateTime;
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

        if ($request->query('status') == Paket::STATUS_UNPICKED_UP) {
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
        if (auth()->user()->cannot('viewAll', Paket::class)) {
            abort(403);
        }

        $pakets = Paket::orderBy('tanggal_sampai', 'desc')->get();

        $role = (new UserRole())->getRole(auth()->user()->role_id);
        return view(sprintf('paket.%s.index', $role), [
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
        if (auth()->user()->cannot('viewUnpickedUp', Paket::class)) {
            abort(403);
        }

        // Filter used to get paket.
        $filter = [
            'nik_karyawan' => auth()->user()->nik,
            'tanggal_diambil' => null,
        ];

        // Get data paket order by tanggal sampai DESC.
        $pakets = Paket::where($filter)
            ->orderBy('tanggal_sampai', 'desc')
            ->get();

        // Collect and prevent duplicate ids of karyawan.
        $karyawanIDs = array();
        foreach ($pakets as $paket) {
            if (Arr::exists($karyawanIDs, $paket->nik_karyawan)) {
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
            $paketDetail->cara_penerimaan = "";
            if ($paket->penerimaan_id > 0) {
                $penerimaan = Penerimaan::find($paket->penerimaan_id);
                if ($penerimaan != null) {
                    $paketDetail->cara_penerimaan = (new Penerimaan())->getPenerimaanText($penerimaan->name);
                }
            }

            array_push($paketDetails, $paketDetail);
        }

        return view('paket.karyawan.index_unpicked_up', [
            'pakets' => $paketDetails
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

        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // time now
        $now = Carbon::now();

        $userPenerima = User::where('nik', $request->nik_penerima)->first();
        $userPetugas = User::where('nik', $request->nik_petugas)->first();

        // new paket
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

        $paketDetail = $this->defaultPaketDetail();

        $paket = Paket::find($id);
        if ($paket != null) {
            $user = User::where('nik', $paket->nik_karyawan)->first();
            $direktorat = ($user->direktorat_id > 0) ? Direktorat::find($user->direktorat_id) : null;
            $divisi = ($user->divisi_id > 0) ? Divisi::find($user->divisi_id) : null;
            $department = ($user->department_id > 0) ? Department::find($user->department_id) : null;
            $unit = ($user->unit_id > 0) ? Unit::find($user->unit_id) : null;
            $penerimaan = ($paket->penerimaan_id > 0) ? Penerimaan::find($paket->penerimaan_id) : null;

            $paketDetail->id = $id;
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
            $paketDetail->tanggal_sampai = (strtotime($paket->tanggal_sampai) <= 0 || strtotime($paket->tanggal_sampai) == false) ? "" : (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            $paketDetail->tanggal_ambil = (strtotime($paket->tanggal_diambil) <= 0 || strtotime($paket->tanggal_diambil) == false) ? "" : (new DateTime($paket->tanggal_diambil))->format('d-m-Y');
            $paketDetail->cara_penerimaan = "";
            if ($penerimaan != null) {
                $paketDetail->cara_penerimaan = (new Penerimaan())->getPenerimaanText($penerimaan->name);
            }

            return view('paket.karyawan.detail', [
                'paketDetail' => $paketDetail
            ]);
        }

        return redirect()
            ->route('paket.index', ['status' => 'unpickedup'])
            ->withErrors(['Paket dengan ID <strong class="font-weight-bold">' . $id . '</strong> tidak ditemukan.']);

        /** Uncomment if the block code above failed. **/
        // return redirect()
        //     ->back()
        //     ->withErrors(['Paket dengan ID <strong class="font-weight-bold">' . $id . '</strong> tidak ditemukan.']);
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
