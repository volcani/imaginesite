<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

use comp_hack\API;

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
            'username' => 'required|string|alpha_num|min:4|max:31|unique:users',
            'name' => 'required|string|max:255',
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
    protected function create(array $data)
    {
        $api = new API(config('comphack.api'), $data['username']);
        $resp = $api->Register($data['username'], $data['email'],
            $data['password']);

        if(false === $resp)
        {
            throw ValidationException::withMessages([
                'apierror' => 'Registration Failed: Server in Maintenance'
            ]);
        }

        if('Success' != $resp)
        {
            throw ValidationException::withMessages([
                'apierror' => $resp
            ]);
        }

        if(false === $api->Authenticate($data['password']))
        {
            throw ValidationException::withMessages([
                'apierror' => 'Registration Failed: Server in Maintenance'
            ]);
        }

        return User::create([
            'username' => $data['username'],
            'server_hash' => $api->GetPasswordHash(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
