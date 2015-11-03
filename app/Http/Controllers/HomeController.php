<?php

namespace App\Http\Controllers;

use DB;
use App\Layout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
    * Show the home template 
    */
    public function index()
    {
        $config =  app('App\Http\Controllers\CommonController')->get_config();
        $data['heading_title'] = $config['site_name'];
        Request::session()->put('active_menu', 'home');
        /**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        
        /**
        * Include modules template 
        */
        $data['modules'] = array();
        $config_modules = Layout::getHomePageConfig();
        $ModulesController = app('App\Http\Controllers\ModulesController');
        $data['modules'][] = $ModulesController->main_slider((int)$config_modules['main_slider'], (int)$config_modules['booking'], (int)$config_modules['bookingwithspecial'] );
        $data['modules'][] = $ModulesController->welcome_section((int)$config_modules['welcome_section']);
        $data['modules'][] = $ModulesController->hotel_facilities_section((int)$config_modules['hotel_facilities_section']);
        $data['modules'][] = $ModulesController->about_us_section((int)$config_modules['about_us_section']);
        $data['modules'][] = $ModulesController->contact_bottom((int)$config_modules['contact_bottom']);

        /**
        * Reponse with home template
        */
        return view('home.home', $data);
    }

}