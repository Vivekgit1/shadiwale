<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $data['status'] = 1;
        // dd($data);
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string', 'max:30'],
            'dob' =>    ['required'],
            'occupation' => ['required', 'string', 'max:50'],
            'salary' => ['required', 'integer'],
            'family_type' => ['required', 'string', 'max:30'],
            'manglik' => ['required', 'boolean'],
            'image' => ['image', 'mimes:jpeg,png,jpg','max:6000'],
            'terms' => ['required', 'integer'],
            'status' => ['required'],
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
        $data['status'] = 1;
        if( request()->hasFile('image')){
            $filepath = request()->image->store('userimage', 'public');
            $file = Image::make(public_path('storage/'.  $filepath));
            $data['image'] = 'storage/userimage/'.$file->basename;
            $file->save();
            }else{
                $data['image'] = '';
            }   

        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'occupation' => $data['occupation'],
            'salary' => $data['salary'],
            'family_type' => $data['family_type'],
            'image' => $data['image'],
            'terms' => $data['terms'],
            'status' => $data['status'],
            'manglik' => $data['manglik'],
        ]);

    }
}
