<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    public function PostData(Request $request)
    {
        $action = "取得資料";
        $apiType = "example-get_data";
        $service = new PostService();
        $response = $service->PostData($request);
        return $response;
    }

    public function PostText(Request $request)
    {
        $service = new PostService();
        $response = $service->PostText($request);
        return $response;

    }

    public function GetData(Request $request)
    {
        $this->validate($request, [
            'page' => 'required',
            'number' => 'required'
        ]);
        $service = new PostService();
        $response = $service->GetData($request);
        return $response;
    }

    public function GetShow(Request $request,$id)
    {
        $service = new PostService();
        $response = $service->GetShow($request,$id);
        return $response;

    }
}