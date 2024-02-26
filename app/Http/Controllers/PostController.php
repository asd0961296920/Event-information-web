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
}