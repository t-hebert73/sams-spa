<?php

namespace AlescoSalon\Http\Controllers\Auth;

use AlescoSalon\Http\Controllers\Controller;
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
     * Gets the current csrf token and returns it.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCsrfToken() {
        return response()->json(['csrfToken' => csrf_token()], 200);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        $user = $this->guard()->user();
        $token = $user->createToken($user->name . 's Token');

        $response = [
            'user' => $user,
            'tokenInfo' => $token
        ];

        return response()->json($response, 200);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {

        $authRequirements['email'] = $request->get('email');
        $authRequirements['password'] = $request->get('password');
        $authRequirements['active'] = 1;

        return $this->guard()->attempt(
            $authRequirements, $request->filled('remember')
        );
    }
}
