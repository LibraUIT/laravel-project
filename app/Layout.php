<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;


class Layout extends Model 
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    /**
    * get Home page config
    */
    static public function getHomePageConfig()
    {
        $data = DB::table('layouts')->where('code', 'home_page')->first();
        $config = ['main_slider' => 0,
                             'welcome_section' => FALSE,
                             'hotel_facilities_section' => FALSE,
                             'about_us_section' => FALSE,
                             'contact_bottom' => FALSE,
                             'booking'  => FALSE,
                             'bookingwithspecial' => FALSE
                              ];
        if(isset($data) || $data != NULL)
        {    
           $config = array_merge( $config , unserialize($data->option));
        }
        return $config;
    }

    /**
    * set Home page config
    */
    static public function setHomePageConfig($input)
    {
        DB::table('layouts')->where('code', 'home_page')->delete();
        $create = array( 'code'     => 'home_page',
                             'option'   => serialize($input)
                             );
        return DB::table('layouts')->insert($create);
    }
}
