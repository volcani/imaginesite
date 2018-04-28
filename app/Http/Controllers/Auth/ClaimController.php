<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Lib\ServerAPI;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class ClaimController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Claim Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of existing users who may have
    | had an account prior to the website install going online.
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
     * Show the claim form to register an existing account.
     *
     * @return \Illuminate\Http\Response
     */
    public function showClaimForm()
    {
        return view('auth.claim');
    }

    /**
     * Handle a claim request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function claim(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            'username' => 'required|string|alpha_num|min:4|max:31',
            'password' => 'required|string|min:6',
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
        // Look for the account first.
        $user = User::username($data['username'])->get()->first();

        // Check if the account was claimed already (in database).
        if($user)
        {
            throw ValidationException::withMessages([
                'apierror' => 'Claim Failed: Account claimed or ' .
                    'information not valid.'
            ]);
        }

        $api = new ServerAPI(env('COMP_API', 'http://127.0.0.1:10999/api'),
            $data['username']);
        $resp = $api->Authenticate($data['password']);

        if(false === $resp)
        {
            throw ValidationException::withMessages([
                'apierror' => 'Claim Failed: Server in Maintenance'
            ]);
        }

        $details = $api->GetAccountDetails();

        if(!$details)
        {
            throw ValidationException::withMessages([
                'apierror' => 'Claim Failed: Account claimed or ' .
                    'information not valid.'
            ]);
        }

        return User::create([
            'username' => $details->username,
            'server_hash' => $api->GetPasswordHash(),
            'name' => $details->displayName,
            'email' => $details->email,
            'admin' => (1000 <= $details->userLevel) ? true : false,
            'password' => Hash::make($data['password']),
        ]);
    }
}
