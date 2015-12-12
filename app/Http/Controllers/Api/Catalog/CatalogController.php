<?php

namespace App\Http\Controllers\Api\Catalog;

use App\Catalog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class CatalogController extends Controller
{
    // Add new Category function
    public function addCategory()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $data = array();
        $output = array(
                'status' => 'NO'
        );
        if(count($params) > 0)
        {
            $data['name']           = urldecode( explode('=', $params[0])[1] );
            $data['parent']         = urldecode( explode('=', $params[1])[1] );
            $data['status']         =  ( isset($params[2]) ) ? 1 :  0;
            $res = Catalog::addCategory($data);
            if($res)
            {
                $output = array(
                    'status' => 'OK'
                );
            }
        }
        return response()->json($output);
    }
    //get parent category
    public function getParentCategory()
    {
        $parent = Catalog::getParentCategory();
        $output = array(
                'status' => 'OK',
                'data'   => $parent
            );
        return response()->json($output);
    }

    // get all category
    public function getAllCategory()
    {
        $category = Catalog::getAllCategory();
        $output = array(
                'status' => 'OK',
                'data'   => $category
            );
        return response()->json($output);
    }

    // delete category by id
    public function deleteCategoryById()
    {
        $request_body = file_get_contents('php://input');
        $categoryId = (int) $request_body;
        $res = Catalog::deleteCategoryById($categoryId);
        $output = array(
                'status' => 'No'
            );
        if($res == TRUE)
        {
            Catalog::deleteCategoryByParentId($categoryId);
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($output);
    }

    // get category by id
    public function getCategoryById()
    {
        $request_body = file_get_contents('php://input');
        $categoryId = (int) $request_body;
        $res = Catalog::getCategoryById($categoryId);
        $output = array(
                'status' => 'No'
            );
        if($res)
        {
            $output = array(
                'status' => 'OK',
                'data'   => $res
            );
        }
        return response()->json($output);
    }

    // update category by id
    public function editCategory()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $data = array();
        $output = array(
                'status' => 'NO'
        );
        if(count($params) > 0)
        {
            $categoryId             = (int) explode('=', $params[0])[1];
            $data['name']           = urldecode( explode('=', $params[1])[1] );
            $data['parent']         = explode('=', $params[2])[1];
            if($data['parent'] == 'null' || $data['parent'] == 'NULL' || $data['parent'] == '' )
            {
                $data['parent'] = NULL;
            }
            $data['status']         =  ( isset($params[3]) ) ? 1 :  0;
            $res = Catalog::editCategoryByID($data, $categoryId);
        
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($output);
    }

    // add new post
    public function addProduct()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $data = array();
        $output = array(
                'status' => 'NO'
        );
        if(count($params) > 4)
        {
            $data['author']          = urldecode( explode('=', $params[0])[1] );
            $data['title']           = urldecode( explode('=', $params[1])[1] );
            $data['category']        = explode('=', $params[2])[1];
            if($data['category'] == 'null' || $data['category'] == 'NULL' || $data['category'] == '' )
            {
                $data['category'] = NULL;
            }
            $data['content']         = urldecode( explode('=', $params[3])[1] );
            $data['image']           = urldecode( explode('=', $params[4])[1] );
            $data['price']           = urldecode( explode('=', $params[5])[1] );
            $data['status']          =  ( isset($params[6]) ) ? 1 :  0;
            $res = Catalog::addProductCatalog($data);
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($output);
    }

    // delete post by id
    public function deleteProductById()
    {
        $request_body = file_get_contents('php://input');
        $postId = (int) $request_body;
        $output = array(
                'status' => 'No'
            );
        $res = Catalog::deleteProductById($postId);
        if($res == TRUE)
        {
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($output);
    }

    // Get all post content pagination
    public function getAllProductCatalog()
    {
        $limit = $_GET['limit'];
        return Catalog::getAllProduct($limit);
    }

    // get post by id
    public function getProductById()
    {
        $request_body = file_get_contents('php://input');
        $postId = (int) $request_body;
        $res = Catalog::getProductById($postId);
        $output = array(
                'status' => 'No'
            );
        if($res)
        {
            $output = array(
                'status' => 'OK',
                'data'   => $res
            );
        }
        return response()->json($output);
    }

    // update post by id
    public function editProduct()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $data = array();
        $output = array(
                'status' => 'NO'
        );
        if(count($params) > 5)
        {
            $postId                 = (int) explode('=', $params[0])[1];
            //$data['author']          = urldecode( explode('=', $params[1])[1] );
            $data['title']           = urldecode( explode('=', $params[2])[1] );
            $data['category']        = explode('=', $params[3])[1];
            if($data['category'] == 'null' || $data['category'] == 'NULL' || $data['category'] == '' )
            {
                $data['category'] = NULL;
            }
            $data['content']         = urldecode( explode('=', $params[4])[1] );
            $data['image']           = urldecode( explode('=', $params[5])[1] );
            $data['price']           = urldecode( explode('=', $params[6])[1] );
            $data['status']         =  ( isset($params[7]) ) ? 1 :  0;
            $res = Catalog::editProductByID($data, $postId);
        
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($output);
    }
}