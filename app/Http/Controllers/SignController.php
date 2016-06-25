<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class SignController extends Controller
{

    protected $config;
    protected $data;
    public function __construct()
    {
        
        $this->config = app('App\Http\Controllers\CommonController')->get_config();
        $this->data['site_favicon'] =$this->config['site_favicon'];
        $this->data['tagline'] = $this->config['site_tagline'];
        $this->data['description'] = $this->config['site_description'];
        /**
        * Include common template
        */
        $this->data['header'] = app('App\Http\Controllers\CommonController')->header();
        $this->data['footer'] = app('App\Http\Controllers\CommonController')->footer();
    }

    /**
    * Show the sign up template
    */ 
    public function up()
    {
        if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }
        $this->data['heading_title'] = $this->config['site_name'].' | Join Now';
        Request::session()->put('active_menu', '');
        /**
        * Include modules template
        */
        $this->data['module_button_login_facebook'] = app('App\Http\Controllers\ModulesController')->button_login_facebook();
        $this->data['module_customer_register_form'] = app('App\Http\Controllers\ModulesController')->customer_register_form();
        return view('sign.up', $this->data);
    }

    /**
    * Show the sign in template
    */
    public function in()
    {
        
        if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }
        $this->data['heading_title'] = $this->config['site_name'].' | Sign In';
        Request::session()->put('active_menu', '');
        
        /**
        * Include modules template
        */
        $this->data['module_button_login_facebook'] = app('App\Http\Controllers\ModulesController')->button_login_facebook();
        $this->data['module_customer_login_form'] = app('App\Http\Controllers\ModulesController')->customer_login_form();
        return view('sign.in', $this->data);
    }

    /**
    * Show the forgot template
    */
    public function forgot()
    {
    	if (Auth::check()) {
            return redirect()->action('HomeController@index');
        }
        $this->data['heading_title'] = $this->config['site_name'].' | Forgot Password';
        Request::session()->put('active_menu', '');
        /**
        * Include modules template
        */
        $this->data['module_customer_forgot_form'] = app('App\Http\Controllers\ModulesController')->customer_forgot_form();
        return view('sign.forgot', $this->data);
    }

    public function out(Route $route)
    {
        Auth::logout();
        return redirect()->action('HomeController@index');
    }
}