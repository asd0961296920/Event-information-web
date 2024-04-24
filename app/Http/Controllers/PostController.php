<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\HtmlPythonRequest;
use App\Models\JS;
use App\Models\User;
class PostController extends Controller
{
    public function PostData(Request $request)
    {
        $action = "取得資料";
        $apiType = "example-get_data";
        $service = new PostService();
        $response = $service->PostDataMain($request);
        return $response;
    }

    public function PostDataOne(Request $request)
    {
        $action = "取得單筆資料";
        $apiType = "example-get_data";
        $service = new PostService();
        $response = $service->PostDataMain($request);
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
            'number' => 'required',
            'city_id' =>'sometimes',
            'keyword' =>'sometimes',
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
    public function test(HtmlPythonRequest $request)
    {
        $service = new PostService();
        $response = $service->test($request);
        return $response;
    }
    public function js(Request $request)
    {
        $jsModel = JS::first();

        return $jsModel;
    }

    public function user(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);
        $User = User::first();
        $password = md5($request->input('password'));
        if($User->password == $password){
            return [
                'login'=>true,
                'token'=>$password
            ];
        }else{
            return [
                'login'=>false
            ];
        }
    }
    public function token(Request $request)
    {

        $User = User::first();
        return [
            'token' =>$User->password ?? ''
        ];
    }
}