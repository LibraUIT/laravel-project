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
}