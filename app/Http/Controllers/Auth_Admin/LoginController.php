<?php

namespace App\Http\Controllers\Auth_Admin;

use App\Http\Controllers\Controller;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('authAdmin.login');
    }

    public function username(){
        return 'username';
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $credential =[
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::guard('admin')->attempt($credential,$request->member)){
            return redirect()->intended(route('admin'));
        }
        return redirect()->back()->withInput($request->only('username','remember'));
    }

     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
