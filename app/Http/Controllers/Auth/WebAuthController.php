<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use comp_hack\API;

class WebAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Web Authentication Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the client login box.
    |
    */

    /**
     * Handle an index request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message = 'Access to this page is denied.';
        $username = '';
        $password = '';
        $client_version = '';
        $can_login = false;
        $idsave = false;

        return view('auth.webauth', compact('message', 'username',
            'can_login', 'client_version', 'idsave'));
    }

    /**
     * Handle a login or quit request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $message = 'Please enter your username and password.';
        $username = request('ID');
        $password = request('PASS');
        $client_version = request('cv');
        $can_login = true; /// TODO: Check the client version?
        $idsave = request('IDSAVE');
        $birthday = false;
        $sid1 = '';
        $sid2 = '';

        if(1 == request('quit'))
        {
            return view('auth.webauth_quit');
        }
        else if(1 == request('login'))
        {
            $api = new API(env('COMP_API', 'http://127.0.0.1:10999/api'),
                $username);

            if(false === $api->Authenticate($password))
            {
                $message = 'Server is in maintenance.';
                $can_login = false;
            }

            $response = $api->GetWebAuthLogin($client_version);

            if(!$response)
            {
                $message = 'Invalid username or password.';
            }
            else
            {
                if(0 == $response->errorCode)
                {
                    $sid1 = $response->sid1;
                    $sid2 = $response->sid2;

                    return view('auth.webauth_authenticated', compact(
                        'username', 'idsave', 'birthday', 'sid1', 'sid2'));
                }
                else
                {
                    $message = $response->error;
                    $can_login = false;
                }
            }
        }

        return view('auth.webauth', compact('message', 'username',
            'can_login', 'client_version', 'idsave'));
    }
}
