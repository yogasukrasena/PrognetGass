<?php

namespace App\Http\Controllers\Auth_Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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
        $this->middleware('auth:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //       'username'      => ['required','string','unique:admins'],
    //       'name'          => ['required','string'],
    //       'password'      => ['required','string','min:6','confirmed'],
    //       'profile_image' => ['required','string'],
    //       'phone'         => ['required','string','min:11'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
          'username'      => ['required','string','unique:admins'],
          'name'          => ['required','string'],
          'password'      => ['required','string','min:6','confirmed'],
          'phone'         => ['required','string','min:11','max:12'],
      ]);
          if($validator->fails()) {
            return redirect()->route('admin.form')
                        ->withErrors($validator)
                        ->withInput();
        }
        $inData = new Admin();
        $inData->username = $request->username;
        $inData->name = $request->name;
        $inData->password = Hash::make($request->password);

        if($file=$request->file('profileimage')){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $file->move(public_path('images/fotoProfile'), $filenameToStore);
            $inData->profile_image = $filenameToStore;
        }
        $inData->phone = $request->phone;
        $inData->save();

     
      return redirect()->back()->with('alert','Data Sukses di Tambahkan');
        // return Admin::create([
        //     'username' => $data['username'],
        //     'name' => $data['name'],
        //     'password' => Hash::make($data['password']),
        //     if('profile_image' => $data['profileimage']){
        //         $filenameWithExt = $file->getClientOriginalName();
        //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //         $extension = $file->getallheaders()tClientOriginalExtension();
        //         $filenameToStore = $filename.'_'.time().'.'.$extension;
        //         $path = $file->move(public_path('images/fotoProfile'), $filenameToStore);
        //         'profile_image' => $filenameToStore;
        //     }
        //     'phone' => $data['phone'],
        //     'status' => 'aktif',
        // ]);
    }

    public function showFormAdmin()
    {
        return view('authAdmin.registerAdmin');
    }


}
