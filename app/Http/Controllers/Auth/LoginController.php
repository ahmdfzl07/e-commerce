<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $checkUser = User::where('email', $credentials['email'])
            ->first();
        // $role = $checkUser->roles->pluck('name');

        if ($checkUser) {
            if (Auth::attempt($credentials)) {
                if ($checkUser->role == "admin") {
                    return redirect()->intended('/dashboard');
                } else {
                    return redirect()->intended('/');
                }
            }
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
