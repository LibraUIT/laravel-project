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
    public function setGeneral()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $data = array();
        $i = 0;
        if(count($params) > 0)
        {
            while ($i < count($params)) {
                $array = explode('=', $params[$i]);
                $data[$array[0]] = $array[1];
                $i++;
            }
        }
        Setting::setGeneral($data);
        $output = array(
                'status' => 'OK'
        );
        return response()->json($output);
    }
    
    public function getGeneral()
    {
        $config = Setting::getGeneral();
        $output = array(
                'status' => 'OK',
                'data'   => $config
            );
        return response()->json($output);
    }
}