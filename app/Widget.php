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
    * edit gallery
    */

    static public function editGallery($data, $id)
    {
        return DB::table('gallerys')->where('id', $id)->update($data);
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

    /**
    * add new hotel facilties
    */

    static public function addHotelFacilties($input)
    {
        return DB::table('hotel_facilties')->insert($input);
    }

    /**
    * get all hotel facilties
    */

    static public function getAllHotelFacilties($limit = 1)
    {
        $gallerys = DB::table('hotel_facilties')->orderBy('id', 'desc')->paginate($limit);      
        return $gallerys->toJson();
    }

    /**
    * edit hotel facilties
    */

    static public function editHotelFacilties($data, $id)
    {
        return DB::table('hotel_facilties')->where('id', $id)->update($data);
    }

    /**
    * add Background Function
    */
    static public function addBackground($code, $background)
    {
        DB::table('backgrounds')->where('code', $code)->delete();
        return DB::table('backgrounds')->insert($background);
    }

    /**
    * get Background Function
    */
    static public function getBackground($code)
    {
        $data = DB::table('backgrounds')->where('code', $code)->first();
        if(isset($data) )
        {    
           return $data;
        }else
        {
            return FALSE;
        }
    }

    /**
    * remove Background Function
    */
    static public function removeBackground($code)
    {
        DB::table('backgrounds')->where('code', $code)->delete();
        return TRUE;
    }

}
