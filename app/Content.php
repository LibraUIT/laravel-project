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
    * get parent category
    */
    static public function getParentCategory()
    {
        return DB::table('categorys')->whereNull('parent')->get();
    }

}
