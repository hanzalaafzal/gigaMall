<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Redirect;
use Helper;
use App\Wallet;


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
    protected $redirectTo = '/login';

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
            'user_name' => 'required|string|max:20|min:5|regex:/(^([a-zA-Z0-9_]+)(\d+)?$)/u|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function showRegistrationForm(){
        return view('newFrontend.pages.register');
    }

    protected function create(array $data)
    {
        $status = true;
        if ($data['user_type'] == 1) {
            $userType = 3;
            $status = false;
        }
        if ($data['user_type'] == 2) {
            $userType = 4;
        }
        if ($data['user_type'] == 3) {
            $userType = 5;
            $status = false;
        }
        $user = User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'status' => $status,
            'permissions_id' => $userType,    // Permission Group ID
            'password' => bcrypt($data['password']),
        ]);

        $wallet = new wallet();
        $wallet->user_id = $user->id;
        $wallet->amount = 0;
        $wallet->referral_bonus = 0;
        $wallet->status = 'Active';
        $wallet->save();

        return $user;
    }
}
