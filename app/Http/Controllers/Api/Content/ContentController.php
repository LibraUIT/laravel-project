<?php

namespace App\Http\Controllers\Api\Content;

use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ContentController extends Controller
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
            $res = Content::addCategory($data);
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
        $parent = Content::getParentCategory();
        $output = array(
                'status' => 'OK',
                'data'   => $parent
            );
        return response()->json($output);
    }

    // get all category
    public function getAllCategory()
    {
        $category = Content::getAllCategory();
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
        $res = Content::deleteCategoryById($categoryId);
        $output = array(
                'status' => 'No'
            );
        if($res == TRUE)
        {
            Content::deleteCategoryByParentId($categoryId);
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
        $res = Content::getCategoryById($categoryId);
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
            $res = Content::editCategoryByID($data, $categoryId);
        
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($output);
    }

    // add new post
    public function addPost()
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
            $data['cover']           = urldecode( explode('=', $params[4])[1] );
            $data['status']         =  ( isset($params[5]) ) ? 1 :  0;
            $res = Content::addPostContent($data);
            $output = array(
                'status' => 'OK'
            );
        }
        return response()->json($data);
    }
}