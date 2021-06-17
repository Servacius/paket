<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Direktorat;
use App\Models\Divisi;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
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
}
