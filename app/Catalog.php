<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;


class Catalog extends Model
{

    /**
    * add new category
    */
    static public function addCategory($data)
    {
        return DB::table('catalog_categorys')->insert($data);
    }

    /**
    * get parent category
    */
    static public function getParentCategory()
    {
        return DB::table('catalog_categorys')->whereNull('parent')->get();
    }

    /**
    * get all category
    */
    static public function getAllCategory()
    {
        $data = DB::table('catalog_categorys')
        ->orderBy('id', 'desc')
        ->get();
        $newdata = array();
        foreach($data as $k => $v)
        {
            if($v->parent != NULL)
            {
                $v->parent = self::getCategoryById($v->parent)->name;
                $newdata[] = $v;
            }else
            {
                $newdata[] = $v;
            }
        }
        return $newdata;
    }

    /**
    * get category by id
    */
    static public function getCategoryById($id)
    {
        return DB::table('catalog_categorys')->where('id', $id)->first();
    }

    /**
    * delete category by id
    */
    static public function deleteCategoryById($id)
    {
        DB::table('catalog_categorys')->where('id', $id)->delete();
        return TRUE;
    }

    /**
    * delete category by parent id
    */
    static public function deleteCategoryByParentId($id)
    {
        DB::table('catalog_categorys')->where('parent', $id)->delete();
        return TRUE;
    }

    /**
    * edit category by id
    */

    static public function editCategoryByID($data, $id)
    {
        return DB::table('catalog_categorys')->where('id', $id)->update($data);
    }

    /**
    * add new post
    */
    static public function addProductCatalog($data)
    {
        return DB::table('catalog_products')->insert($data);
    }

    /**
    * delete post by id
    */
    static public function deleteProductById($id)
    {
        DB::table('catalog_products')->where('id', $id)->delete();
        return TRUE;
    }

    /**
    * edit post by id
    */

    static public function editProductById($data, $id)
    {
        return DB::table('catalog_products')->where('id', $id)->update($data);
    }

    /**
    * get all product
    */

    static public function getAllProduct($limit = 1)
    {
        $posts = DB::table('catalog_products')
        ->join('users', 'users.email', '=', 'catalog_products.author')
        ->select('catalog_products.*', 'users.name')
        ->orderBy('id', 'desc')->paginate($limit);
        return $posts->toJson();
    }

     /**
    * get all product best seller
    */

    static public function getAllProductBestSeller($limit = 1)
    {
        $posts = DB::table('catalog_products')
        ->join('users', 'users.email', '=', 'catalog_products.author')
        ->select('catalog_products.*', 'users.name')
        ->orderBy('id', 'asc')->paginate($limit);
        return $posts->toJson();
    }

    /**
    * get post by id
    */
    static public function getProductById($id)
    {
        return DB::table('catalog_products')->where('id', $id)->first();
    }

    static public function getAllProductByCategory($id, $limit = 1)
    {
        $posts = DB::table('catalog_products')
        ->select('*')
        ->where('category', $id)
        ->orderBy('id', 'desc')->paginate($limit);
        return $posts->toJson();
    }

}
