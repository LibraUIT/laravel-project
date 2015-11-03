<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PagesController extends Controller
{
	
	public $_config;

	public function __construct()
	{
		$this->_config = app('App\Http\Controllers\CommonController')->get_config();
	}

	/**
	* Show the contact page template
	*/
	public function contact()
	{
		$data['heading_title'] = $this->_config['site_name'].' | Contact';
		$data['heading_contact_title'] = trans('common.heading_contact_title') . $this->_config['site_name'];
		Request::session()->put('active_menu', 'contact');
		/**
		* Include modules template
        */
        $data['module_customer_contact_form'] = app('App\Http\Controllers\ModulesController')->customer_contact_form();
        $data['module_address'] = app('App\Http\Controllers\ModulesController')->address();
        $data['module_social_media'] = app('App\Http\Controllers\ModulesController')->social_media();
		/**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('pages.contact', $data);
	}

	/**
	* Show the about page template
	*/
	public function about()
	{
		$data['heading_title'] = $this->_config['site_name'].' | About Us';
		Request::session()->put('active_menu', 'about');
		/**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('pages.about', $data);
	}

	/**
	* Show the gallery page template
	*/
	public function gallery()
	{
		$data['heading_title'] = $this->_config['site_name'].' | Gallery';
		Request::session()->put('active_menu', 'gallery');
		$data['modules'][] = app('App\Http\Controllers\ModulesController')->pinterest($visible = 1);
		/**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('pages.gallery', $data);
	}

	/**
	* Show the 404 page template
	*/
	public function page_404()
	{
		$data['heading_title'] = $this->_config['site_name'].' | 404 Page Not Found';
		Request::session()->put('active_menu', '404');
		/**
        * Include common template
        */
        $data['header'] = app('App\Http\Controllers\CommonController')->header();
        $data['footer'] = app('App\Http\Controllers\CommonController')->footer();
        return view('pages.404', $data);
	}
}