<?php

namespace App\Http\Controllers\Api\Authenticate;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class AuthenticateController extends Controller
{
    public function getToken()
    {
        if( Request::method() == 'POST' )
        {
            $token = Request::session()->token();
            return response()->json($token);
        }
    }
    public function login()
    {
        $credentials = Request::only('email', 'password');
        $output = '';
        if ( Auth::attempt($credentials) )
        {
            $uGroup = Auth::user()->group;
            if($uGroup == 1)
            {
               $token = str_random(40);
               $output = array(
                'token' => $token
               ); 
            }
            
        }
        return response()->json($output);
    }
}