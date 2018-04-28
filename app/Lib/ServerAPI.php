<?php

namespace App\Lib;

class ServerAPI extends \comp_hack\API
{
    protected function SaveSession()
    {
        session()->put('api_username', $this->username);
        session()->put('api_password_hash', $this->password_hash);
        session()->put('api_challenge', $this->challenge);
    } // function SaveSession

    public static function Session($server)
    {
        $api = new ServerAPI($server, session()->get('api_username'));
        $api->password_hash = session()->get('api_password_hash');
        $api->challenge = session()->get('api_challenge');

        return $api;
    } // function Session
} // class ServerAPI
