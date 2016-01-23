<?php

namespace App\Http\Controllers\Api\Widget;

use DB;
use File;
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

    public function editGallery()
    {
       $request_body = file_get_contents('php://input');
       $params = explode('&', $request_body);
       $i = 0;
       if(count($params) >= 3 && count($params) % 3 == 0)
        {
            while($i < count($params))
            {
                $text = explode('=', $params[$i])[1];
                $image= explode('=', $params[++$i])[1];
                $id   = explode('=', $params[++$i])[1];
                if( stripos( $image , 'image_not_found.jpg') == FALSE)
                {
                    $data = array(
                        'title' => urldecode ($text),
                        'image'=> urldecode ($image)
                    );  
                }
                
                $i++;
            }
       };
       $res = Widget::editGallery($data, $id);
       $output = array(
                'status' => 'NO'
            );
       if($res)
       {
            $output = array(
                'status' => 'OK'
            );
       }
       
       return response()->json($output);
    }

    // get all gallery by @limit param
    public function getAllGallery()
    {
        $limit = $_GET['limit'];
        return Widget::getallGallery($limit);
    }

    // Delete gallery by  id
    public function delGalleryById()
    {
        $id = file_get_contents('php://input');
        /*$gallery =  DB::table('gallerys')->where('id', (int)$id )->first();
        $output = array(
                'status' => 'NO',
                'message' => 'Image not exist.'
        );
        if($gallery)
        {
            
            $image = $gallery->image;
            $image = str_replace('../storage/app', storage_path('app'), $image);
            if(File::exists( $image ))
            {
                File::delete($image);
                DB::table('gallerys')->where('id', (int)$id )->delete();
                $output = array(
                    'status' => 'OK',
                    'message' => 'Deleted has been success'
                );
            }
        }*/
        DB::table('gallerys')->where('id', (int)$id )->delete();
        $output = array(
                    'status' => 'OK',
                    'message' => 'Deleted has been success'
        );
        return response()->json($output);
    }

    public function addHotelFacilties()
    {
        $request_body = file_get_contents('php://input');
        $params = explode('&', $request_body);
        $i = 0;
            
        $data['name']           = urldecode( explode('=', $params[$i])[1] );
        $data['icon']           = urldecode( explode('=', $params[++$i])[1] );
        $data['image']          = urldecode( explode('=', $params[++$i])[1] );
        $data['big_heading']    = urldecode( explode('=', $params[++$i])[1] );
        $data['small_heading']  = urldecode( explode('=', $params[++$i])[1] );
        $data['description']    = urldecode( explode('=', $params[++$i])[1] );
        $data['start']          = urldecode( explode('=', $params[++$i])[1] );
        $data['end']            = urldecode( explode('=', $params[++$i])[1] );
        $data['charge']         = urldecode( explode('=', $params[++$i])[1] );
        $data['status']         =  ( isset($params[++$i]) ) ? 1 :  0;
        
        
        $res = Widget::addHotelFacilties($data);
        $output = array(
                'status' => 'NO'
            );
        if($res)
        {
            $output = array(
                'status' => 'OK'
            );
        }
       
        return response()->json($output);

    }

    // get all hotel facilties by @limit param
    public function getAllHotelFacilties()
    {
        $limit = $_GET['limit'];
        return Widget::getAllHotelFacilties($limit);
    }

    // Delete hotel facilties by  id
    public function delHotelFaciltiesById()
    {
        $id = file_get_contents('php://input');
        DB::table('hotel_facilties')->where('id', (int)$id )->delete();
        $output = array(
                    'status' => 'OK',
                    'message' => 'Deleted has been success'
        );
        return response()->json($output);
    }

    // Edit hotel facilties by id
    public function editHotelFacilties()
    {
        $request_body = file_get_contents('php://input');
        $res_params = explode(',', $request_body);
        $output = array(
                'status' => 'NO'
            );
        if(count($res_params == 2))
        {
            $id =  explode(':', $res_params[1]);
            $id = (int) str_replace('}', '', $id[1]);
            $input = explode(':', $res_params[0])[1];
            $input = str_replace('"', '', $input);
            $params = explode('&', $input);
            $i = 0;
                
            $data['name']           = urldecode( explode('=', $params[$i])[1] );
            $data['icon']           = urldecode( explode('=', $params[++$i])[1] );
            $data['image']          = urldecode( explode('=', $params[++$i])[1] );
            $data['big_heading']    = urldecode( explode('=', $params[++$i])[1] );
            $data['small_heading']  = urldecode( explode('=', $params[++$i])[1] );
            $data['description']    = urldecode( explode('=', $params[++$i])[1] );
            $data['start']          = urldecode( explode('=', $params[++$i])[1] );
            $data['end']            = urldecode( explode('=', $params[++$i])[1] );
            $data['charge']         = urldecode( explode('=', $params[++$i])[1] );
            $data['status']         =  ( isset($params[++$i]) ) ? 1 :  0;
            $res = Widget::editHotelFacilties($data, $id);
            $output = array(
                'status' => 'OK'
            );
     
        }
        return response()->json($output);
    }

    // Add Background Hotel Facilties Function
    public function addBackgroundHotelFacilties()
    {
       $request_body = file_get_contents('php://input');
       $res_params = explode('=', $request_body);
       $output = array(
                'status' => 'NO'
            );
        if( count($res_params) == 2 && $res_params[0] == 'background')
        {
            $code = 'hotel_facilties';
            $background = array(
                    'code'       => $code,
                    'background' => urldecode($res_params[1])
                );
            $res = Widget::addBackground($code, $background);
            if($res)
            {
               $output = array(
                    'status' => 'OK'
               ); 
            }      
        }
        return response()->json($output);     
    }

    // Get Background Hotel Facilties Function
    public function getBackgroundHotelFacilties()
    {
        $code = 'hotel_facilties';
        $res = Widget::getBackground($code);
        $output = array(
                'status' => 'NO'
            );
        if($res && $res->background != '')
        {
            $output = array(
                    'status' => 'OK',
                    'data'   => $res
               ); 
        }
        return response()->json($output); 
    }

    // Remove Background Hotel Facilties Function
    public function removeBackgroundHotelFacilties()
    {
        $code = 'hotel_facilties';
        $res = Widget::removeBackground($code);
        $output = array(
                'status' => 'NO'
            );
        if($res == TRUE)
        {
            $output = array(
                    'status' => 'OK'
               ); 
        }
        return response()->json($output); 
    }
}