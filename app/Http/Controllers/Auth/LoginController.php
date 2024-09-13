<?php

namespace App\Http\Controllers\Auth;

use Log;
use Closure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, Authenticatable $user)
    {
        Log::info('User authenticated:', ['user_id' => $user->id]);

        if ($user->is_admin) {
            Log::info('Redirecting admin to admin route');
            return redirect()->route('admin');
        }

        Log::info('Redirecting user to intended route');
        return redirect()->route('login');
    }
}
