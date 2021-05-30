<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
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
}
