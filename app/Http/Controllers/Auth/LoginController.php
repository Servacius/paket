<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            // 'email' => 'required|email',
            'nik' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('nik' => $input['nik'], 'password' => $input['password']))) {
            switch (auth()->user()->role_id) {
                case UserRole::ROLE_ID_ADMINISTRATOR:
                    return redirect()->route('admin.home');

                case UserRole::ROLE_ID_KARYAWAN:
                    return redirect()->route('index');

                case UserRole::ROLE_ID_PETUGAS:
                    return redirect()->route('index');
            }
        }

        return redirect()
            ->route('login')
            ->withErrors(['Pasangan NIK dan password salah. Silahkan coba lagi.']);
    }
}
