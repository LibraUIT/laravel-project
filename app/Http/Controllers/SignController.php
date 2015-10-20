<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class SignController extends Controller
{

    /**
    * Show the sign up template
    */ 
    public function up()
    {
        if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }
        $data['heading_title'] = 'Hotel Booking | Join Now';
        Request::session()->put('active_menu', '');
        /**
        * Include modules template
        */
        $data['module_button_login_facebook'] = app('App\Http\Controllers\ModulesController')->button_login_facebook();
        $data['module_customer_register_form'] = app('App\Http\Controllers\ModulesController')->customer_register_form();
        /**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('sign.up', $data);
    }

    /**
    * Show the sign in template
    */
    public function in()
    {
        
        if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }
        $data['heading_title'] = 'Hotel Booking | Sign In';
        Request::session()->put('active_menu', '');
        
        /**
        * Include modules template
        */
        $data['module_button_login_facebook'] = app('App\Http\Controllers\ModulesController')->button_login_facebook();
        $data['module_customer_login_form'] = app('App\Http\Controllers\ModulesController')->customer_login_form();
        /**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('sign.in', $data);
    }

    /**
    * Show the forgot template
    */
    public function forgot()
    {
    	if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }
        $data['heading_title'] = 'Hotel Booking | Forgot Password';
        Request::session()->put('active_menu', '');
        /**
        * Include modules template
        */
        $data['module_customer_forgot_form'] = app('App\Http\Controllers\ModulesController')->customer_forgot_form();
        /**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('sign.forgot', $data);
    }

    public function out()
    {
        Auth::logout();
        return redirect()->action('HomeController@index');
    }
}