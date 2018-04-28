<?php

namespace App\Http\Controllers;

use App\Lib\ServerAPI;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function api()
    {
        return ServerAPI::Session(env('COMP_API',
            'http://127.0.0.1:10999/api'));
    }
}
