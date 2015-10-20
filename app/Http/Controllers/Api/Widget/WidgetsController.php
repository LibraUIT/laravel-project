<?php

namespace App\Http\Controllers\Api\Widget;

use DB;
use App\Widget;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class WidgetsController extends Controller
{
    public function setMainSlider()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $data = array();
        $i = 0;
        if(count($params) >= 3 && count($params) % 3 == 0)
        {
            while($i < count($params))
            {
                $text = explode('=', $params[$i])[1];
                $link = explode('=', $params[++$i])[1];
                $image= explode('=', $params[++$i])[1];
                $data[] = array(
                        'text' => urldecode ($text),
                        'link' => urldecode ($link),
                        'image'=> urldecode ($image)
                    );
                $i++;
            }
        };
        Widget::setMainSliderConfig($data);
        $output = array(
                'status' => 'OK'
        );
        return response()->json($output);

    }
    public function getMainSlider()
    {
        $config = Widget::getMainSliderConfig();
        $output = array(
                'status' => 'OK',
                'data'   => $config
            );
        return response()->json($output);
    }
}