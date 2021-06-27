<?php

namespace App\Http\Controllers;

use App\Exports\PaketExport;
use App\Mail\PaketEmail;
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
use Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirect into index page by conditions.
     *
     * @param Request $request
     * @return void
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
     * Return page contains all paket.
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
     * Return page contains paket with cara penerimaan confirmed.
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
     * Return page contains unpickedup paket.
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
     * Return report page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
        if (auth()->user()->cannot('report', Paket::class)) {
            abort(403);
        }

        $app = app();
        $filter = $app->make('stdClass');
        $filter->nama = "";
        $filter->tanggal_sampai_from = "";
        $filter->tanggal_sampai_to = "";
        $filter->tanggal_diambil_from = "";
        $filter->tanggal_diambil_to = "";

        if ($request->nama != "") {
            $filter->nama = $request->nama;
        }
        if ($request->tanggal_sampai_from != "") {
            $filter->tanggal_sampai_from = $request->tanggal_sampai_from;
        }
        if ($request->tanggal_sampai_to != "") {
            $filter->tanggal_sampai_to = $request->tanggal_sampai_to;
        }
        if ($request->tanggal_diambil_from != "") {
            $filter->tanggal_diambil_from = $request->tanggal_diambil_from;
        }
        if ($request->tanggal_diambil_to != "") {
            $filter->tanggal_diambil_to = $request->tanggal_diambil_to;
        }

        return view('paket.admin.report', [
            'filter' => $filter
        ]);
    }

    /**
     * Return search response.
     *
     * @param Request $request
     * @return json $pakets
     */
    public function search(Request $request)
    {
        $filter = [];
        if ($request->nama != "") {
            $filter['nama'] = $request->nama;
        }
        if ($request->tanggal_sampai_from != "") {
            $filter['tanggal_sampai_from'] = $request->tanggal_sampai_from;
        }
        if ($request->tanggal_sampai_to != "") {
            $filter['tanggal_sampai_to'] = $request->tanggal_sampai_to;
        }
        if ($request->tanggal_diambil_from != "") {
            $filter['tanggal_diambil_from'] = $request->tanggal_diambil_from;
        }
        if ($request->tanggal_diambil_to != "") {
            $filter['tanggal_diambil_to'] = $request->tanggal_diambil_to;
        }

        $pakets = $this->fetchPaket($filter);

        return response()->json($pakets);
    }

    public function export(Request $request)
    {
        if (auth()->user()->cannot('export', Paket::class)) {
            abort(403);
        }

        $filter = [];
        if ($request->nama != "") {
            $filter['nama'] = $request->nama;
        }
        if ($request->tanggal_sampai_from != "") {
            $filter['tanggal_sampai_from'] = $request->tanggal_sampai_from;
        }
        if ($request->tanggal_sampai_to != "") {
            $filter['tanggal_sampai_to'] = $request->tanggal_sampai_to;
        }
        if ($request->tanggal_diambil_from != "") {
            $filter['tanggal_diambil_from'] = $request->tanggal_diambil_from;
        }
        if ($request->tanggal_diambil_to != "") {
            $filter['tanggal_diambil_to'] = $request->tanggal_diambil_to;
        }

        if ($request->input('action') == 'export-xslx') {
            return Excel::download(new PaketExport($filter), 'Report Penerimaan Paket.xlsx');
        } else if ($request->input('action') == 'export-csv') {
            return Excel::download(new PaketExport($filter), 'Report Penerimaan Paket.csv');
        }
    }

    /**
     * Return create paket form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (auth()->user()->cannot('create', Paket::class)) {
            abort(403);
        }

        return view('paket.petugas.form_tambah_paket');
    }

    /**
     * Store new paket.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        if (auth()->user()->cannot('create', Paket::class)) {
            abort(403);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'required' => 'Gambar paket tidak boleh kosong.',
                'mimes' => 'Tipe gambar yang diperbolehkan: jpeg,png,jpg,gif,svg.',
                'max' => 'Ukuran gambar maksimal 2048kb.'
            ]
        );

        if ($validator->fails()) {
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

        try {
            $data = [
                'nik' => $userPenerima->nik,
                'nama' => $userPenerima->name,
                'tanggal_sampai' => $paket->tanggal_sampai,
                'link' => URL::signedRoute('paket.detail', ['id' => $paket->id])
            ];
            $this->sendEmail($userPenerima->email, $data);
        } catch (\Exception $e) {
            return redirect()
                ->route('paket.index')
                ->with('success', 'Paket berhasil ditambahkan.')
                ->withErrors(['Email kepada karyawan gagal dikirimkan.']);
        }

        return redirect()
            ->route('paket.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Return detail page of paket.
     *
     * @param int $id
     * @return void
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
     * Update status paket to done.
     *
     * @param int $id
     * @return void
     */
    public function done($id)
    {
        if (auth()->user()->cannot('done', Paket::class)) {
            abort(403);
        }

        $now = Carbon::now();

        // Update paket record.
        Paket::where('id', $id)
            ->update(['tanggal_diambil' => $now->toDateTimeString()]);

        return redirect()
            ->route('paket.index', ['unpickedup' => 'true']);
    }

    /**
     * Send email.
     *
     * @param string $email
     * @param array $data
     * @return bool
     */
    public function sendEmail($email, $data)
    {
        Mail::to($email)->send(new PaketEmail($data));

        return true;
    }

    /**
     * Fetch paket by filters.
     *
     * @param array $filter
     * @return json $arrayDetails
     */
    private function fetchPaket($filter)
    {
        $query = Paket::select(
            'id',
            'name',
            'nik_karyawan',
            'penerimaan_id',
            'jenis_barang',
            'barang_berbahaya',
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

        // Fetch and order paket by 'tanggal_sampai' DESC.
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

        $direktorats = $this->fetchDirektoratData();
        $departments = $this->fetchDepartmentData();
        $divisies = $this->fetchDivisiData();
        $units = $this->fetchUnitData();

        $app = app();

        // Mapping paket and its user karyawan.
        $paketDetails = array();
        foreach ($pakets as $paket) {
            if ($karyawans[$paket->nik_karyawan] == null) {
                continue;
            }

            $karyawanPemilik = $karyawans[$paket->nik_karyawan];

            $paketDetail = $app->make('stdClass');
            $paketDetail->id = $paket->id;
            $paketDetail->nama_paket = $paket->name;
            $paketDetail->jenis_paket = $paket->jenis_barang;
            $paketDetail->barang_berbahaya = ($paket->barang_berbahaya == 1) ? "Ya" : "Tidak";
            $paketDetail->nama_pemilik = $karyawanPemilik->name;
            $paketDetail->nik_pemilik = $karyawanPemilik->nik;
            $paketDetail->no_telepon = $karyawanPemilik->no_telp;
            $paketDetail->email = $karyawanPemilik->email;
            $paketDetail->gambar = $paket->picture;
            $paketDetail->tanggal_sampai = (new DateTime($paket->tanggal_sampai))->format('d-m-Y');
            $paketDetail->tanggal_pengantaran = "";
            $paketDetail->tanggal_diambil = "";
            $paketDetail->waktu_pengantaran = "";
            $paketDetail->cara_penerimaan = "";
            $paketDetail->telat_diambil = false;
            $paketDetail->telat_diantar = false;

            $paketDetail->direktorat = "";
            if ($karyawanPemilik->direktorat_id != null) {
                $paketDetail->direktorat = $direktorats[$karyawanPemilik->direktorat_id]->name;
            }
            $paketDetail->department = "";
            if ($karyawanPemilik->department_id != null) {
                $paketDetail->department = $departments[$karyawanPemilik->department_id]->name;
            }
            $paketDetail->divisi = "";
            if ($karyawanPemilik->divisi_id != null) {
                $paketDetail->divisi = $divisies[$karyawanPemilik->divisi_id]->name;
            }
            $paketDetail->unit = "";
            if ($karyawanPemilik->unit_id != null) {
                $paketDetail->unit = $units[$karyawanPemilik->unit_id]->name;
            }

            if ($paket->tanggal_diambil != null) {
                $paketDetail->tanggal_diambil = (new DateTime($paket->tanggal_diambil))->format('d-m-Y');
            }

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

        $paketDetails = $this->cleanDataPaketByFilter($paketDetails, $filter);

        return $paketDetails;
    }

    /**
     * Clean data paket by Filter
     *
     * @param array $filter
     * @return array $paketDetails
     */
    private function cleanDataPaketByFilter($paketDetails, $filter)
    {
        if (Arr::exists($filter, 'nama')) {
            $resultFiltered = array();
            foreach ($paketDetails as $paketDetail) {
                if (str_contains(strtolower($paketDetail->nama_pemilik), strtolower($filter['nama']))) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_sampai_from')) {
            $resultFiltered = array();
            $from = (new DateTime($filter['tanggal_sampai_from']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_sampai != "" && $paketDetail->tanggal_sampai >= $from) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_sampai_to')) {
            $resultFiltered = array();
            $to = (new DateTime($filter['tanggal_sampai_to']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                if ($paketDetail->tanggal_sampai != "" && $paketDetail->tanggal_sampai  <= $to) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_diambil_from')) {
            $resultFiltered = array();
            $from = (new DateTime($filter['tanggal_diambil_from']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                $date = $paketDetail->tanggal_diambil;
                if ($paketDetail->cara_penerimaan == Penerimaan::PENERIMAAN_DIANTAR) {
                    $date = $paketDetail->tanggal_pengantaran;
                }

                if ($date != "" && $date >= $from) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }
        if (Arr::exists($filter, 'tanggal_diambil_to')) {
            $resultFiltered = array();
            $to = (new DateTime($filter['tanggal_diambil_to']))->format('d-m-Y');
            foreach ($paketDetails as $paketDetail) {
                $date = $paketDetail->tanggal_diambil;
                if ($paketDetail->cara_penerimaan == Penerimaan::PENERIMAAN_DIANTAR) {
                    $date = $paketDetail->tanggal_pengantaran;
                }

                if ($date != "" && $date  <= $to) {
                    array_push($resultFiltered, $paketDetail);
                }
            }

            $paketDetails = $resultFiltered;
        }

        return $paketDetails;
    }

    /**
     * Fetch units.
     *
     * @return array $units
     */
    private function fetchUnitData()
    {
        $data = Unit::all();

        $units = array();
        foreach ($data as $d) {
            $units[$d->id] = $d;
        }

        return $units;
    }

    /**
     * Fetch direktorats.
     *
     * @return array $direktorats
     */
    private function fetchDirektoratData()
    {
        $data = Direktorat::all();

        $direktorats = array();
        foreach ($data as $d) {
            $direktorats[$d->id] = $d;
        }

        return $direktorats;
    }

    /**
     * Fetch departments.
     *
     * @return array $departments
     */
    private function fetchDepartmentData()
    {
        $data = Department::all();

        $departments = array();
        foreach ($data as $d) {
            $departments[$d->id] = $d;
        }

        return $departments;
    }

    /**
     * Fetch divisies.
     *
     * @return array $divisies
     */
    private function fetchDivisiData()
    {
        $data = Divisi::all();

        $divisies = array();
        foreach ($data as $d) {
            $divisies[$d->id] = $d;
        }

        return $divisies;
    }

    /**
     * Get detail paket by paket id.
     *
     * @param int $id
     * @return null | $paketDetails
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
            $paketDetail->tanggal_diambil = "";
            $paketDetail->tanggal_diantar = "";
            $paketDetail->waktu_diantar = "";
            $paketDetail->lantai_diantar = "";
            $paketDetail->keterangan_diantar = "";
            $paketDetail->cara_penerimaan = "";

            if ($penerimaan != null) {
                $paketDetail->cara_penerimaan = (new Penerimaan())->getPenerimaanText($penerimaan->name);

                switch ($penerimaan->name) {
                    case Penerimaan::PENERIMAAN_DIANTAR:
                        if ($penerimaan->catatan != null) {
                            $catatan = json_decode($penerimaan->catatan);
                            if (property_exists($catatan, 'tanggal_pengantaran')) {
                                $paketDetail->tanggal_diantar = (new DateTime($catatan->tanggal_pengantaran))->format('d-m-Y');
                            }
                            if (property_exists($catatan, 'waktu_pengantaran')) {
                                $paketDetail->waktu_diantar = $catatan->waktu_pengantaran;
                            }
                            if (property_exists($catatan, 'lantai')) {
                                $paketDetail->lantai_diantar = $catatan->lantai;
                            }
                            if (property_exists($catatan, 'keterangan')) {
                                $paketDetail->keterangan_diantar = $catatan->keterangan;
                            }
                        }

                        if ($paket->tanggal_diambil != null) {
                            $paketDetail->tanggal_diantar = (new DateTime($paket->tanggal_diambil))->format('d-m-Y');
                        }
                        break;

                    case Penerimaan::PENERIMAAN_AMBIL_SENDIRI:
                        if ($paket->tanggal_diambil != null) {
                            $paketDetail->tanggal_diambil = (new DateTime($paket->tanggal_diambil))->format('d-m-Y');
                        }
                        break;
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
                if (property_exists($catatan, 'waktu_pengantaran')) {
                    $paketDetail->waktu_diantar = $catatan->waktu_pengantaran;
                }
                if (property_exists($catatan, 'lantai')) {
                    $paketDetail->lantai_diantar = $catatan->lantai;
                }
                if (property_exists($catatan, 'keterangan')) {
                    $paketDetail->keterangan_diantar = $catatan->keterangan;
                }
            }

            return $paketDetail;
        }

        return null;
    }
}
