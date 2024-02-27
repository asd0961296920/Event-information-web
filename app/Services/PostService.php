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

            $html = $this->api->getWebpage($htmlPython->url);
            $texts =  $this->api->html_url($html, $htmlPython->body_filter, $htmlPython->title_filter);
            foreach ($texts as $text) {
                if ($htmlPython->connect_url != null) {
                    $html_post = $this->api->getWebpage($htmlPython->connect_url . $text['url']);

                    $post_text =  $this->api->html_text($html_post, $htmlPython->post_filter);
                    $this->api->postModel($text['text'],$post_text,$text['url'],'',$htmlPython->name,$htmlPython->url,$htmlPython->id,$htmlPython->area_id);

                } else {
                    $html_post = $this->api->getWebpage($text['url']);

                    $post_text =  $this->api->html_text($html_post, $htmlPython->post_filter);
                    $this->api->postModel($text['text'],$post_text,$text['url'],'',$htmlPython->name,$htmlPython->url,$htmlPython->id,$htmlPython->area_id);

                }
            }
        }



        return $texts;
    }


    public function PostText(Request $request)
    {
        $html = $this->api->getWebpage('https://pthg.tainanoutlook.com/');
        $text =  $this->api->html_url($html, '.view-content', '.masonry-item');
        return $text;
    }
}
