<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    /**
    * get Config for website
    */
    public function get_config()
    {
        /**
        * get setting config
        */
        $set = Setting::getGeneral();
        $config = array();
        $config['site_logo']        = isset($set['image']) ? str_replace('..', '', $set['image']) : "" ;
        $config['site_favicon']     = isset($set['favicon']) ? str_replace('..', '', $set['favicon']) : "" ;
        $config['site_name']        = $set['sitetitle'];
        $config['site_tagline']     = $set['tagline'];
        $config['site_description'] = $set['description'];
        $config['site_numberphone'] = $set['numberphone'];
        $config['site_email']       = $set['email'];
        $config['site_address']     = $set['address'];
        $config['site_facebook']    = $set['facebook'];
        $config['site_google']      = $set['google'];
        $config['site_twitter']     = $set['twitter'];
        return $config;
    }

    /**
    * Show the header template
    */
    public function header()
    {
        $get_config = $this->get_config();
        $data['site_logo'] = $get_config['site_logo'];
        $data['site_favicon'] = $get_config['site_favicon'];
        $data['site_title'] = $get_config['site_name'];
        $data['home_url'] = action('HomeController@index');
        $data['register_url'] = action('SignController@up');
        $data['login_url'] = action('SignController@in');
        $data['logout_url'] = action('SignController@out');
        $data['contact_url'] = action('PagesController@contact');
        $data['about_url'] = action('PagesController@about');
        $data['page_404_url'] = action('PagesController@page_404');
        $data['gallery_url'] = action('PagesController@gallery');
        $data['news_url'] = action('PagesController@page_news');
        return view('layouts.header', $data);
    }

    /**
    * Show the footer template
    */
    public function footer()
    {
    	return view('layouts.footer');
    }
}
