<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function list(Request $request)
    {
        $response = Area::where('nation','台灣')->where('upid' , 1)->get();
        return $response;
    }

    public function show(Request $request,$id)
    {
        $response = Area::where('id',$id)->first();
        return $response;

    }



}