<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\Catalog;
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

	/**
	* Show the news template
	*/
	public function page_news()
	{
		$this->data['heading_title'] = $this->config['site_name'].' | News';
		Request::session()->put('active_menu', 'news');
		$this->data['modules'][] = app('App\Http\Controllers\ModulesController')->news($visible = 1);
    return view('pages.news', $this->data);
	}

	/**
	* Show the catalog template
	*/
	public function page_catalog()
	{
		$this->data['categories'] = Catalog::getAllCategory();
		$this->data['heading_title'] = $this->config['site_name'].' | Catalog';
		Request::session()->put('active_menu', 'catalog');
		$this->data['slider'] = app('App\Http\Controllers\ModulesController')->main_slider($visible = 1);
		$this->data['modules'][] = app('App\Http\Controllers\ModulesController')->catalog($visible = 1);
    return view('pages.catalog', $this->data);
	}

	/**
	* Show catalog category
	*/
	public function page_catalog_category($id)
	{
		$this->data['category'] = $category = Catalog::getCategoryById($id);
		$this->data['heading_title'] = $this->config['site_name'].' | '.$category->name;
		$this->data['products'] = json_decode(Catalog::getAllProductByCategory($category->id));
		Request::session()->put('active_menu', 'catalog');
    return view('pages.catalog_category', $this->data);
	}

	/**
	* Show the catalog product template
	*/
	public function page_catalog_product($id, $name)
	{
		$this->data['product'] = $product = Catalog::getProductById($id);
		if(!$product)
		{
			return redirect()->action('PagesController@page_404');
		}
		$this->data['heading_title'] = $product->title;
		$this->data['categories'] = Catalog::getAllCategory();
		Request::session()->put('active_menu', 'catalog');
		$this->data['products']       = json_decode( Catalog::getAllProduct(6) );
		$this->data['modules'] = array();
		return view('pages.catalog_product', $this->data);
	}
	/**
	* Show the catalog cart template
	*/
	public function page_catalog_cart($id = NULL)
	{
		$product = Catalog::getProductById($id);
		if(!$product)
		{
			return redirect()->action('PagesController@page_catalog');
		}
		$this->data['heading_title'] = $this->config['site_name'].' | Cart';
		Request::session()->put('active_menu', 'catalog');
		$item = array(
				$id => $product
			);
		if( session('catalog_cart') )
		{
			$item = session('catalog_cart');
			$isset = array_key_exists ( $id ,  $item );
			if(!$isset)
			{
				$item[$id] = $product;
				Request::session()->put('catalog_cart', $item);
			}
		}else
		{
			Request::session()->put('catalog_cart', $item);
		}
		$this->data['cart'] = array();
		if(session('catalog_cart'))
		{
			$this->data['cart'] = session('catalog_cart');
		}

		return view('pages.catalog_cart', $this->data);
	}

	/**
	* Delete item in cart
	*/
	public function page_catalog_cart_delete($id)
	{
		$item = session('catalog_cart');
		$isset = array_key_exists ( $id ,  $item );
		if($isset)
		{
			unset($item[$id]);
			Request::session()->put('catalog_cart', $item);
		}
		return redirect()->action('PagesController@page_catalog_cart_show');
	}

	/**
	* Empty cart
	*/
	public function empty_cart()
	{
		Request::session()->forget('catalog_cart');
		return redirect()->action('PagesController@page_catalog_cart_show');
	}
	/**
	* Show cart template
	*/
	public function page_catalog_cart_show()
	{
		$this->data['heading_title'] = $this->config['site_name'].' | Cart';
		Request::session()->put('active_menu', 'catalog_cart');
		$this->data['cart'] = array();
		if(session('catalog_cart'))
		{
			$this->data['cart'] = session('catalog_cart');
		}

		return view('pages.catalog_cart', $this->data);
	}
	/**
	* Show the checkout page
	*/
	public function page_cart_checkout()
	{
		if(!Auth::check())
		{
			Request::session()->flash('message_error', 'Please login to continue !');
			Request::session()->put('url_to_redirect', 'PagesController@page_cart_checkout');
			return redirect()->action('SignController@in');
		}else
		{
      $this->data['fullname'] = Auth::user()->name;
      $this->data['email']    = Auth::user()->email;
			$this->data['heading_title'] = $this->config['site_name'].' | Checkout';
			Request::session()->put('active_menu', 'catalog_cart');
			$this->data['cart'] = array();
			if(session('catalog_cart'))
			{
				$this->data['cart'] = session('catalog_cart');
			}
			$this->data['form_action'] = action('PagesController@page_cart_checkout_confirm');
			return view('pages.catalog_cart_checkout', $this->data);
		}
	}


	/**
	* Cofirm checkout
	*/
	public function page_cart_checkout_confirm()
	{
		if( Request::method() == 'POST'  && Request::input('_token') == Request::session()->token() )
		{
			if(!Auth::check())
			{
				Request::session()->flash('message_error', 'Please login to continue !');
				Request::session()->put('url_to_redirect', 'PagesController@page_cart_checkout');
				return redirect()->action('SignController@in');
			}else
			{
	      $params = Request::all();
	      $order = array(
	      		'user_id' => Auth::user()->id,
	      		'user_name' => $params['fullname'],
	      		'user_email' => $params['email'],
	      		'user_phone' => $params['phone'],
	      		'user_address' => $params['address'],
	      		'cart' => serialize(session('catalog_cart'))

	      	);
	      Order::addOrder($order);
	      Request::session()->forget('catalog_cart');
	      Request::session()->flash('message_success', 'Thank you! Checkout has been success. We will contact with you after.');
	      return redirect()->action('PagesController@page_profile');

			}
		}else
		{
			return redirect()->action('PagesController@page_404');
		}

	}

	/**
	* show the profile page template
	*/
	public function page_profile()
	{
		if(!Auth::check())
		{
			Request::session()->flash('message_error', 'Please login to continue !');
			Request::session()->put('url_to_redirect', 'PagesController@page_profile');
			return redirect()->action('SignController@in');
		}else
		{
			$this->data['heading_title'] = $this->config['site_name'].' | Profile';
			$this->data['profile'] = Auth::user();
			$this->data['orders'] = Order::getAllOrderByUserId(Auth::user()->id);
			Request::session()->forget('active_menu');
			return view('pages.profile', $this->data);
		}
	}

}