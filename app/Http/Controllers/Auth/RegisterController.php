<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_image' => 'profile_image',
            'status' => 0,
            'remember_token' => str_random(190)
        ]);
    }

    public function activating($token)
    {
        $model = User::where([
            'remember_token' => $token,
            'status'  => 0
        ])
            ->firstOrFail();
        $model->status = 1;
        $model->email_verified_at = date('Y-m-d H:i:s');
        $model->save();
        return 'akun anda telah aktif silahkan login.';
    }

    // public function photo(request $request, $id)
    // {

    //     if($file=$request->file('profileimage')){
    //         $filenameWithExt = $file->getClientOriginalName();
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         $extension = $file->getClientOriginalExtension();
    //         $filenameToStore = $filename.'_'.time().'.'.$extension;
    //         $path = $file->move(public_path('images/fotoProfile'), $filenameToStore);
    //         $inData->profile_image = $filenameToStore;
    // }
}
