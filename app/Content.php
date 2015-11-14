<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;


class Content extends Model 
{

    /**
    * add new category
    */
    static public function addCategory($data)
    {
        return DB::table('categorys')->insert($data);
    }

    /**
    * get Main slider config
    */
    static public function getGeneral()
    {
        $data = DB::table('settings')->where('code', 'general')->first();
        $config = array(
                'sitetitle'     => '',
                'tagline'       => '',
                'description'   => '',
                'email'         => '',
                'address'       => '',
                'numberphone'   => '',
                'facebook'      => '',
                'google'        => '',
                'twitter'       => ''
            );
        if(isset($data) || $data != NULL)
        {    
           $config = array_merge( $config , unserialize($data->option));
        }
        $newconfig = array();
        foreach($config as $k => $v)
        {
            $newconfig[$k] = urldecode($v);
        }
        return $newconfig;
    }

    /**
    * set general
    */
    static public function setGeneral($input)
    {
        DB::table('settings')->where('code', 'general')->delete();
        $create = array( 'code'     => 'general',
                             'option'   => serialize($input)
                             );
        return DB::table('settings')->insert($create);
    }

}
