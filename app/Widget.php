<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;


class Widget extends Model 
{

    /**
    * get Main slider config
    */
    static public function getMainSliderConfig()
    {
        $data = DB::table('widgets')->where('code', 'main_slider')->first();
        $config = array();
        if(isset($data) || $data != NULL)
        {    
           $config = array_merge( $config , unserialize($data->option));
        }
        return $config;
    }

    /**
    * set Main slider config
    */
    static public function setMainSliderConfig($input)
    {
        DB::table('widgets')->where('code', 'main_slider')->delete();
        $create = array( 'code'     => 'main_slider',
                             'option'   => serialize($input)
                             );
        return DB::table('widgets')->insert($create);
    }

    /**
    * add new gallery
    */

    static public function addGallery($input)
    {
        return DB::table('gallerys')->insert($input);
    }

    /**
    * get all gallery
    */

    static public function getallGallery($limit = 1)
    {
        $gallerys = DB::table('gallerys')->orderBy('id', 'desc')->paginate($limit);      
        return $gallerys->toJson();
    }
    /**
    * get pagination gallery
    */

    static public function getpagiantionGallery($limit = 1)
    {
        $gallerys = DB::table('gallerys')->orderBy('id', 'desc')->paginate($limit);      
        return $gallerys;
    }

}
