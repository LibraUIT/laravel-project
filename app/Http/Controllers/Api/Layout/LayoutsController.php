<?php

namespace App\Http\Controllers\Api\Layout;

use DB;
use App\Layout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class LayoutsController extends Controller
{
    protected $_table;
    public function __construct()
    {
    	$this->_table = DB::table('layouts');
    }

    public function getHomePageConfig()
    {
        $config = Layout::getHomePageConfig();
        $output = array(
        		'status' => 'OK',
        		'data'	 => $config
        	);
        return response()->json($output);
    }
    public function setHomePageConfig()
    {
    	Layout::setHomePageConfig(Request::input('data'));
    	$output = array(
        		'status' => 'OK'
        );
        return response()->json($output);
    }
}