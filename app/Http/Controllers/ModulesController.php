<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Layout;
use App\Widget;
use App\Content;
use App\Catalog;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ModulesController extends Controller
{
    public $_config;

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->_config = app('App\Http\Controllers\CommonController')->get_config();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function singin_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
    }

    protected function singup_validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => 'required|max:255|min:6',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);
    }

    protected function forgot_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users'
        ]);
    }

    protected function contact_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'title' => 'required|min:6',
            'message' => 'required|min:50'  
        ]);
    }

    /**
    * Show the loader template
    */
    public function loader()
    {
    	$data['first_text']  = 'Hotel';
        $data['second_text'] = '-Booking';
        return view('modules.loader', $data);
    }

    /**
    * Show the main slider template
    */
    public function main_slider($visible = 0, $booking = 0, $bookingwithspecial = 0)
    {
        $data['module_hotel_booking_area'] = $this->hotel_booking_area($booking, $bookingwithspecial );
        $data['config'] = Widget::getMainSliderConfig();
        if($visible == 1)
        {
           return view('modules.main_slider', $data); 
        }
        
    }

    /**
    * Show the hotel booking area
    */
    public function hotel_booking_area($booking, $bookingwithspecial)
    {
        if($booking == 1)
        {
            $data['bookingwithspecial'] = $bookingwithspecial;
            return view('modules.hotel_booking_area', $data);
        }
    }

    /** 
    * Show the welcome section template
    */
    public function welcome_section($visible = 0)
    {
        if($visible == 1)
        {
            return view('modules.welcome_section');
        }
    }

    /**
    * Show the hotel facilities section template
    */
    public function hotel_facilities_section($visible = 0)
    {
        $data = array();
        if($visible == 1)
        {
            $code = 'hotel_facilties';
            $data['hotel_facilities'] = DB::table('hotel_facilties')->orderBy('id', 'desc')->get();
            $background = DB::table('backgrounds')->where('code', $code)->first();
            $data['background'] = (isset($background) ? $background->background : FALSE );
            return view('modules.hotel_facilities_section', $data);
        }
    }

    /**
    * Show the about us section template
    */
    public function about_us_section($visible = 0)
    {
        if($visible == 1)
        {
            return view('modules.about_us_section');
        }
    }

    /**
    * Show the contact bottom template
    */ 
    public function contact_bottom($visible = 0)
    {
        if($visible == 1)
        {
            $data['site_email']      = $this->_config['site_email'];
            $data['site_numberphone']= $this->_config['site_numberphone'];
            return view('modules.contact_bottom', $data);
        }
    }

    /**
    * Show the button login with facebook
    */
    public function button_login_facebook()
    {
        return view('modules.button_login_facebook');
    }

    protected $registrar;

    /** 
    * Show the customer login form
    */
    public function customer_login_form()
    {
        $data['forgot_url'] = action('SignController@forgot');
        $data['form_action'] = action('SignController@in');
        if( Request::method() == 'POST' && Request::input('_token') == Request::session()->token() )
        {
            $validator = $this->singin_validator(Request::all());
            if ($validator->fails())
            {
                return view('modules.customer_login_form', $data)->withErrors($validator->errors());
                
            }
           if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password')])) {
                // Authentication passed...
                if(session('url_to_redirect'))
                {
                    $url_to_redirect = session('url_to_redirect');
                    Request::session()->forget('url_to_redirect');
                    return redirect()->action($url_to_redirect);
                }
                return redirect()->action('HomeController@index');
            }


        }

        return view('modules.customer_login_form', $data);
    }

    /** 
    * Show the customer forgot form
    */
    public function customer_forgot_form()
    {
        $data['sign_up_url'] = action('SignController@up');
        $data['form_action'] = action('SignController@forgot');
        if( Request::method() == 'POST' && Request::input('_token') == Request::session()->token() )
        {
            //var_dump(Request::all());
        }

        return view('modules.customer_forgot_form', $data); 
    }

    /** 
    * Show the customer register form
    */
    public function customer_register_form()
    {
        $data['sign_in_url'] = action('SignController@in');
        $data['form_action'] = action('SignController@up');
        if( Request::method() == 'POST' && Request::input('_token') == Request::session()->token() )
        {
            $validator = $this->singup_validator(Request::all());
            if ($validator->fails())
            {
                return view('modules.customer_register_form', $data)->withErrors($validator->errors());
            }
            $user = DB::table('users')->where('email', Request::input('email'))
            ->first();
            if(!isset($user) || $user == NULL)
            {
                $insert = array(
                                'name'     => Request::input('fullname'),
                                'email'    => Request::input('email'),
                                'password' => bcrypt(Request::input('password'))
                 );
                User::create($insert);
                return redirect('auth/login')->with('success_message', trans('messages.user_created_success'));
            }else
            {
                $data['error_message'] = trans('messages.user_exists');
            }

        }

        return view('modules.customer_register_form', $data); 
    }

    /** 
    * Show the customer contact form
    */
    public function customer_contact_form()
    {
        $data['email'] = '';
        if(Auth::check())
        {
            $data['email'] = Auth::user()->email;
        }

        $data['form_action'] = action('PagesController@contact');
        if( Request::method() == 'POST' && Request::input('_token') == Request::session()->token() )
        {
            //var_dump(Request::all());
            $validator = $this->contact_validator(Request::all());
            if ($validator->fails())
            {
                return view('modules.customer_contact_form', $data)->withErrors($validator->errors());
                
            }
        }
        return view('modules.customer_contact_form', $data); 
    }

    /** 
    * Show the addresss module
    */
    public function address()
    {
        $data['site_name']       = $this->_config['site_name'];
        $data['site_email']      = $this->_config['site_email'];
        $data['site_address']    = htmlentities($this->_config['site_address'], ENT_QUOTES);
        return view('modules.address', $data); 
    }

    /** 
    * Show the social media module
    */
    public function social_media()
    {
        $data['site_facebook']   = $this->_config['site_facebook'];
        $data['site_google']     = $this->_config['site_google'];
        $data['site_twitter']    = $this->_config['site_twitter'];
        return view('modules.social_media', $data); 
    }

    /**
    * Show the pinterest module
    */
    public function pinterest($visible = 0)
    {
        if($visible == 1)
        {
            $data['gallerys'] = DB::table('gallerys')->orderBy('id', 'desc')->get();
            $data['pswp']     = app('App\Http\Controllers\ModulesController')->pswp();
            return view('modules.pinterest', $data);
        }        
    }

    /**
    * Show the pswp template
    */
    public function pswp()
    {
        return view('modules.pswp');
    }

    /**
    * Show the news module
    */
    public function news($visible = 0)
    {
        $data['categories'] = Content::getAllCategory();
        $data['posts'] = json_decode( Content::getAllPost(10) );
        return view('modules.news', $data);
    }

    /**
    * Show the catalog module
    */
    public function catalog($visible = 0)
    {
        $data['products']       = json_decode( Catalog::getAllProduct(6) );
        $data['bestsellers']    = json_decode( Catalog::getAllProductBestSeller(6) );
        return view('modules.catalog', $data);
    }

}