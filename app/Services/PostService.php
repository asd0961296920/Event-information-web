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

class PostService
{
    protected $api;

    public function __construct()
    {
        $this->api = new PostApi();
    }

    public function PostData(Request $request)
    {
        $htmlPythons = HtmlPython::get();

        foreach ($htmlPythons as $htmlPython) {
            if ($htmlPython->enble) {



                $html = $this->api->getWebpage($htmlPython->url);
                $texts =  $this->api->html_url($html, $htmlPython->body_filter, $htmlPython->title_filter);
                $this->api->post_text($texts, $htmlPython);
                if ($htmlPython->page_bool) {
                    if ($htmlPython->table_page != null) {

                        for ($i = 2; $i < $htmlPython->page + 2; $i++) {
                            $html = $this->api->getWebpage($htmlPython->url . $htmlPython->table_page . $i);
                            $texts =  $this->api->html_url($html, $htmlPython->body_filter, $htmlPython->title_filter);
                            $this->api->post_text($texts, $htmlPython);
                        }
                    } else {
                        for ($i = 2; $i < $htmlPython->page + 2; $i++) {
                            $html = $this->api->getWebpage($htmlPython->url . '/' . $i);
                            $texts =  $this->api->html_url($html, $htmlPython->body_filter, $htmlPython->title_filter);
                            $this->api->post_text($texts, $htmlPython);
                        }
                    }
                }
            }
        }



        return $texts ?? 'ok';
    }


    public function PostText(Request $request)
    {
        $html = $this->api->getWebpage('https://pthg.tainanoutlook.com/');
        $text =  $this->api->html_url($html, '.view-content', '.masonry-item');
        return $text;
    }
}