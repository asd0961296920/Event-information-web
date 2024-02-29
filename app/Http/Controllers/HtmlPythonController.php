<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HtmlPythonService;
use App\Http\Requests\HtmlPythonRequest;

class HtmlPythonController extends Controller
{
    public function list(Request $request)
    {
        $service = new HtmlPythonService();
        $response = $service->list($request);
        return $response;
    }

    public function show(HtmlPythonRequest $request,$id)
    {
        $service = new HtmlPythonService();
        $response = $service->show($request,$id);
        return $response;

    }

    public function post(HtmlPythonRequest $request)
    {
        $service = new HtmlPythonService();
        $response = $service->post($request);
        return $response;

    }
    public function patch(Request $request,$id)
    {
        $service = new HtmlPythonService();
        $response = $service->patch($request,$id);
        return $response;

    }

    public function delete(Request $request,$id)
    {
        $service = new HtmlPythonService();
        $response = $service->delete($request,$id);
        return $response;

    }


}