<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)
                ->where('user_type_id', 1)
                ->first();

        return $user && $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    public function loginMobile(Request $request)
    {
        $user = User::where('email', $request->email)
            ->where('user_type_id', 2)
            ->first();

        return ($user && $this->guard()->attempt(
                    $this->credentials($request), $request->has('remember')
                ))
        ? response()->json(['success' => 'true', 'user' => $user], 200)
        : response()->json(['success' => 'false'], 400);

    }
}
