<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;


class Order extends Model 
{

    /**
    * add new order
    */
    static public function addOrder($data)
    {
        return DB::table('orders')->insert($data);
    }

    /**
    * get all orders
    */
    static public function getAllOrder()
    {
        $data = DB::table('orders')
        ->orderBy('id', 'desc')
        ->get();
        return $data;
    }

    /**
    * get order by user id
    */
    static function getAllOrderByUserId($id)
    {
        return DB::table('orders')->where('user_id', $id) 
        ->orderBy('id', 'desc')
        ->get();;
    }

    /**
    * get all order
    */

    static public function getAllOrderCatalog($limit = 1)
    {
        $orders = DB::table('orders')->orderBy('id', 'desc')->paginate($limit);      
        return $orders->toJson();
    }


}
