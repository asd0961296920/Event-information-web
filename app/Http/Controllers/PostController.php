<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\HtmlPythonRequest;
use App\Models\JS;
use App\Models\User;
use App\Models\Post;
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

    public function PostDataOne(Request $request,$id)
    {
        $action = "取得單筆資料";
        $apiType = "example-get_data";
        $service = new PostService();
        $response = $service->PostDataMainOne($request,$id);
        return $response;
    }

    public function PostText(Request $request)
    {
        $service = new PostService();
        $response = $service->PostText($request);
        return $response;

    }
    public function PostText123(Request $request)
    {
        $service = new PostService();
        $response = $service->PostText123($request);
        return $response;

    }

    public function GetData(Request $request)
    {
        $this->validate($request, [
            'page' => 'required',
            'number' => 'required',
            'city_id' =>'sometimes',
            'keyword' =>'sometimes',
            'year' =>'sometimes|integer|nullable',
            'moth' =>'sometimes|integer|nullable',
        ]);
        $service = new PostService();
        $response = $service->GetData($request);
        return $response;
    }
    public function GetAll(Request $request)
    {
        return Post::all();

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
                'token'=>$password,
            ];
        }else{
            return [
                'login'=>false,
            ];
        }
    }

    public function get_user(Request $request)
    {

        $User = User::first();
        return $User;

    }

    public function user_chrome(Request $request)
    {
        $this->validate($request, [
            'chrome' => 'required|boolean',
        ]);
        $user = User::first();

        $user->chrome = $request->input("chrome");

        $user->save();
        return 200;

    }
    public function token(Request $request)
    {

        $User = User::first();
        return [
            'token' =>$User->password ?? ''
        ];
    }
}