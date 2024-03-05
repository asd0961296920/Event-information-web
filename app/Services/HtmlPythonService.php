<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Area;
use DOMDocument;
use DOMXPath;
use App\Api\PostApi;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Post;
use App\Models\HtmlPython;
use App\Http\Requests\HtmlPythonRequest;

class HtmlPythonService
{
    protected $api;

    public function __construct()
    {
        $this->api = new PostApi();
    }

    public function list(Request $request)
    {

        return HtmlPython::with(['area'])->get();
    }


    public function show(Request $request, $id)
    {
        return HtmlPython::where('id', $id)->first();
    }

    public function post(HtmlPythonRequest $request)
    {
        $HtmlPython = new HtmlPython();
        $HtmlPython->fill($request->all())->save();
        return $HtmlPython;
    }

    public function patch(HtmlPythonRequest $request, $id)
    {
        $HtmlPython =   HtmlPython::where('id', $id)->first();
        $HtmlPython = $request->all();
        return $HtmlPython;
    }

    public function delete(Request $request, $id)
    {
        return HtmlPython::where('id', $id)->delete();
    }
}
