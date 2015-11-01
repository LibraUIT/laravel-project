<?php

namespace App\Http\Controllers\Api\Widget;

use DB;
use App\Widget;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Support\JsonableInterface;

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

    public function addGallery()
    {
       $request_body = file_get_contents('php://input');
       $params = explode('&', $request_body);
       $data = array();
       $i = 0;
       if(count($params) >= 2 && count($params) % 2 == 0)
        {
            while($i < count($params))
            {
                $text = explode('=', $params[$i])[1];
                $image= explode('=', $params[++$i])[1];
                if( stripos( $image , 'image_not_found.jpg') == FALSE)
                {
                    $data[] = array(
                        'title' => urldecode ($text),
                        'image'=> urldecode ($image)
                    );  
                }
                
                $i++;
            }
       };
       Widget::addGallery($data);
       $output = array(
                'status' => 'OK'
        );
       return response()->json($output);
    }

    public function getAllGallery()
    {
        $limit = $_GET['limit'];
        return Widget::getallGallery($limit);
    }
    public function getPaginationGallery()
    {
        $limit = $_GET['limit'];
        $gallerys = Widget::getpagiantionGallery($limit)->toArray();
        $data = array(
                  "draw" => 4,
                  "recordsTotal" => 57,
                  "recordsFiltered" => 57,
                  "data" => $gallerys['data']
            );
        return response()->json($data);
    }
}