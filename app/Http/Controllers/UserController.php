<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Direktorat;
use App\Models\Divisi;
use App\Models\Unit;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    /**
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }
     **/

    public function index()
    {
        $users = $this->fetchAllUser();

        return view('user.index', ['users' => $users]);
    }

    public function autocomplete(Request $request)
    {
        $data = DB::table('users')
            ->select('users.name', 'users.nik', 'users.email', 'department.name as department', 'direktorat.name as direktorat', 'divisi.name as divisi', 'unit.name as unit')
            ->join('department', 'department.id', '=', 'users.department_id')
            ->join('direktorat', 'direktorat.id', '=', 'users.direktorat_id')
            ->join('divisi', 'divisi.id', '=', 'users.divisi_id')
            ->join('unit', 'unit.id', '=', 'users.unit_id')
            ->get();

        return response()->json($data);
    }

    /**
     * Search user by keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $users = [];

        if ($request->has('q')) {
            $search = $request->q;
            $users = User::select('id', 'name')
                ->where('name', 'LIKE', "%$search%")
                ->where('role_id', '=', UserRole::ROLE_ID_KARYAWAN)
                ->get();
        }

        return response()->json($users);
    }

    /**
     * Get detail user by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return null;
        }

        $direktorat = ($user->direktorat_id > 0) ? Direktorat::find($user->direktorat_id) : null;
        $divisi = ($user->divisi_id > 0) ? Divisi::find($user->divisi_id) : null;
        $department = ($user->department_id > 0) ? Department::find($user->department_id) : null;
        $unit = ($user->unit_id > 0) ? Unit::find($user->unit_id) : null;

        $app = app();
        $userDetail = $app->make('stdClass');
        $userDetail->id = $id;
        $userDetail->name = $user->name;
        $userDetail->nik = $user->nik;
        $userDetail->email = $user->email;
        $userDetail->telp = $user->no_telp;
        $userDetail->direktorat = "";
        if ($direktorat != null) {
            $userDetail->direktorat = $direktorat->name;
        }
        $userDetail->divisi = "";
        if ($divisi != null) {
            $userDetail->divisi = $divisi->name;
        }
        $userDetail->department = "";
        if ($department != null) {
            $userDetail->department = $department->name;
        }
        $userDetail->unit = "";
        if ($unit != null) {
            $userDetail->unit = $unit->name;
        }

        return response()->json($userDetail);
    }

    private function fetchAllUser()
    {
        $users = User::select('id', 'nik', 'role_id', 'name', 'email', 'no_telp')
            ->whereIn('role_id', [2, 3])
            ->orderByDesc('created_at')
            ->get();

        $app = app();

        $userDetails = array();
        foreach ($users as $user) {
            $userDetail = $app->make('stdClass');

            $userDetail->id = $user->id;
            $userDetail->nik = $user->nik;
            $userDetail->role = (new UserRole())->getRole($user->role_id);
            $userDetail->nama = $user->name;
            $userDetail->email = $user->email;
            $userDetail->no_telepon = $user->no_telp;

            array_push($userDetails, $userDetail);
        }

        return $userDetails;
    }

    public function register()
    {
        $direktorat = Direktorat::select('id', 'name')->get();
        $divisi = Divisi::select('id', 'name')->get();
        $unit = Unit::select('id', 'name')->get();
        $department = Department::select('id', 'name')->get();

        return view('user.form_register_user', [
            'direktorat' => $direktorat,
            'divisi' => $divisi,
            'unit' => $unit,
            'department' => $department,
        ]);
    }

    public function store(Request $request)
    {
        $now = Carbon::now();

        $user = new User();
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->role_id = $request->role;
        $user->password = Hash::make('secret');
        $user->email = $request->email;
        $user->no_telp = $request->no_telepon;
        $user->direktorat_id = ($request->direktorat != 0) ? $request->direktorat : null;
        $user->divisi_id = ($request->divisi != 0) ? $request->divisi : null;
        $user->department_id = ($request->department != 0) ? $request->department : null;
        $user->unit_id = ($request->unit != 0) ? $request->unit : null;
        $user->created_at = $now;
        $user->updated_at = null;
        $user->deleted_at = null;

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }
}
