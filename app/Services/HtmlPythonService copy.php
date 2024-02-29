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

class HtmlPythonService
{
    protected $api;

    public function __construct()
    {
        $this->api = new PostApi();
    }

    public function GetData(Request $request)
    {



        return $texts ?? 'ok';
    }


    public function GetShow(Request $request)
    {
        $html = $this->api->getWebpage('https://khh.travel/zh-tw/event/calendardetail/5363');

        $text =  $this->api->html_second_floor($html, '.position-relative');
        $text =  $this->api->html_imager_url_one($text, '.embed-responsive-item','jpg');
        // $text =  $this->api->html_url($html, '.view-content', '.masonry-item');
        return $text;
    }
}
