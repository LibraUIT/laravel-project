<?php

namespace App\Http\Controllers\Api\Filemanager;

use DB;
use File;
use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FilemanagerController extends Controller
{
    /**
    * Upload single file
    */ 
    public function uploadSingleFile()
    {
        $destinationPath = storage_path('app').'/uploads/images/';
        
        if(Request::input('folder'))
        {
            $destinationPath = storage_path('app').'/uploads/images/'.Request::input('folder').'/';
        }
       
        if (Request::hasFile('file')) {
            $fileName = Request::file('file')->getClientOriginalName();
            $newFilename = $this->cleanFileName( $fileName );
            //check if file exist
            while (File::exists( $destinationPath . $newFilename)) 
            {
                //if file exit, add unique name
                $newFilename = uniqid() . "_" . $newFilename;
            }
            
            $upload = Request::file('file')->move($destinationPath, $newFilename);
            $output = array(
                    'status' => 'NO',
                    'message'=> 'Upload is failed !'
                );
            if(isset($upload))
            {
                $output = array(
                    'status' => 'OK'
                );
            }
            return response()->json($output);
        }
    }

    public function getAll()
    {
        $request_body = file_get_contents('php://input');
        $directory = '/uploads/images/'.$request_body;
        $directories = Storage::allDirectories($directory);
        $files = Storage::allFiles($directory);
        $output = array();
        foreach($files as $file)
        {
            $params = explode('/', $file);
            $l = count($params);
            $fileName = $params[$l - 1];
            $fileType =  strtoupper( explode('.', $fileName)[1] );
            $filePath = $file;
            $fileSize = round( (Storage::size($filePath) / 1000), 3) . ' KB';
            if($fileType == 'JPG' || $fileType == 'PNG')
            {
                $output[] = array(
                        'file_name' => $fileName,
                        'file_type' => $fileType,
                        'file_path' => $filePath,
                        'file_size' => $fileSize
                    );
            }
        }
        return response()->json($output);
    }

    /*
    * Clean the file name
    */
    private function cleanFileName($fileName)
    {
        //remove blanks
        $fileName = preg_replace('/\s+/', '', $fileName);

    return $fileName;
    }
}