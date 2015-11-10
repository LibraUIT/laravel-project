<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PagesController extends Controller
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
	* Show the contact page template
	*/
	public function contact()
	{
		$this->data['heading_title'] = $this->config['site_name'].' | Contact';
		$this->data['heading_contact_title'] = trans('common.heading_contact_title') . $this->config['site_name'];
		Request::session()->put('active_menu', 'contact');
		/**
		* Include modules template
        */
        $this->data['module_customer_contact_form'] = app('App\Http\Controllers\ModulesController')->customer_contact_form();
        $this->data['module_address'] = app('App\Http\Controllers\ModulesController')->address();
        $this->data['module_social_media'] = app('App\Http\Controllers\ModulesController')->social_media();
        return view('pages.contact', $this->data);
	}

	/**
	* Show the about page template
	*/
	public function about()
	{
		$this->data['heading_title'] = $this->config['site_name'].' | About Us';
		Request::session()->put('active_menu', 'about');
        return view('pages.about', $this->data);
	}

	/**
	* Show the gallery page template
	*/
	public function gallery()
	{
		$this->data['heading_title'] = $this->config['site_name'].' | Gallery';
		Request::session()->put('active_menu', 'gallery');
		$this->data['modules'][] = app('App\Http\Controllers\ModulesController')->pinterest($visible = 1);
        return view('pages.gallery', $this->data);
	}

	/**
	* Show the 404 page template
	*/
	public function page_404()
	{
		$this->data['heading_title'] = $this->config['site_name'].' | 404 Page Not Found';
		Request::session()->put('active_menu', '404');
        return view('pages.404', $this->data);
	}
}