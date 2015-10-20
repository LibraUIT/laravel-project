<?php

namespace App\Http\Controllers\Api\Setting;

use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class SettingsController extends Controller
{
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