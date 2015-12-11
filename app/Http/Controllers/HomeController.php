<?php

namespace App\Http\Controllers;

use DB;
use App\Layout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
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
    * Show the home template 
    */
    public function index()
    {
        $this->data['heading_title'] =$this->config['site_name'];
        Request::session()->put('active_menu', 'home');
        
        /**
        * Include modules template 
        */
        $this->data['modules'] = array();
        $config_modules = Layout::getHomePageConfig();
        $ModulesController = app('App\Http\Controllers\ModulesController');
        $this->data['modules'][] = $ModulesController->main_slider((int)$config_modules['main_slider'], (int)$config_modules['booking'], (int)$config_modules['bookingwithspecial'] );
        $this->data['modules'][] = $ModulesController->welcome_section((int)$config_modules['welcome_section']);
        $this->data['modules'][] = $ModulesController->hotel_facilities_section((int)$config_modules['hotel_facilities_section']);
        $this->data['modules'][] = $ModulesController->pinterest((int)$config_modules['pinterest']);
        $this->data['modules'][] = $ModulesController->about_us_section((int)$config_modules['about_us_section']);
        $this->data['modules'][] = $ModulesController->contact_bottom((int)$config_modules['contact_bottom']);

        /**
        * Reponse with home template
        */
        return view('home.home', $this->data);
    }

}