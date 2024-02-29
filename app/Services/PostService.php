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

            try {


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
            } catch (\Exception $e) {
            }
        }



        return $texts ?? 'ok';
    }


    public function PostText(Request $request)
    {
        $html = $this->api->getWebpage('https://khh.travel/zh-tw/event/calendardetail/5363');

        $text =  $this->api->html_second_floor($html, '.position-relative');
        $text =  $this->api->html_imager_url_one($text, '.embed-responsive-item','jpg');
        // $text =  $this->api->html_url($html, '.view-content', '.masonry-item');
        return $text;
    }


    public function GetData(Request $request)
    {

        $perPage = $request->input('number');
        $page = $request->input('page');
        return Post::with(['html_python','area'])->paginate($perPage, ['*'], 'page', $page);
    }


    public function GetShow(Request $request,$id)
    {
        return Post::where('id',$id)->first();
    }
}
