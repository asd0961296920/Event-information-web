<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Area;
use DOMDocument;
use DOMXPath;
use App\Api\PostApi;
use Symfony\Component\DomCrawler\Crawler;
class PostService 
{
    protected $api;

    public function __construct()
    {
        $this->api = new PostApi();

    }

    public function PostData(Request $request)
    {
        $html = $this->api->getWebpage('https://pthg.tainanoutlook.com/activity/408252618');
        $text =  $this->api->html_text($html,'.field-item');


        return $text;

    }
}
