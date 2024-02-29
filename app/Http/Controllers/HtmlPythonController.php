<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HtmlPythonService;

class HtmlPythonController extends Controller
{
    public function GetData(Request $request)
    {
        $service = new HtmlPythonService();
        $response = $service->GetData($request);
        return $response;
    }

    public function GetShow(Request $request)
    {
        $service = new HtmlPythonService();
        $response = $service->GetShow($request);
        return $response;

    }
}