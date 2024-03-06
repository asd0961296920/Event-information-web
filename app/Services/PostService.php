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
        $html = $this->api->getWebpage('https://pthg.tainanoutlook.com/activity/589064327');

        // $text =  $this->api->html_second_floor($html, '.position-relative');
        // $text =  $this->api->html_imager_url_one($text, '.embed-responsive-item','jpg');
        $text =  $this->api->html_min_date($html, '.field-name-field-date');
        
        $text =  $this->api->tidyDate($text);
        return $text;
    }


    public function GetData(Request $request)
    {

        $perPage = $request->input('number');
        $page = $request->input('page');

        
        if($request->input('city_id')){
            $posts = Post::where('area_id',$request->input('city_id'))->with(['html_python', 'area'])->orderBy('event_date', 'desc')->paginate($perPage, ['*'], 'page', $page);
        }else{
            $posts = Post::with(['html_python', 'area'])->orderBy('event_date', 'desc')->paginate($perPage, ['*'], 'page', $page);
        }
        // 取得當前頁碼
        $currentPage = $posts->currentPage();

        // 取得總共的項目數量
        $totalItems = $posts->total();

        // 取得總共的分頁數量
        $totalPages = $posts->lastPage();



        // 返回結果，包括當前頁碼、總共的項目數量和總共的分頁數量
        return [
            'currentPage' => $currentPage,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'posts' => $posts
        ];
    }


    public function GetShow(Request $request, $id)
    {
        return Post::where('id', $id)->first();
    }

    public function test(Request $request)
    {
        $html = $this->api->getWebpage($request->input('url'));
        $tables = $this->api->html_url($html, $request->input('body_filter'), $request->input('title_filter'));
        $text = [];

        foreach ($tables as $table) {
            if ($request->input('connect_url') != null) {
                $html_post = $this->api->getWebpage($request->input('connect_url') . $table['url']);

                $post_text =  $this->api->html_text($html_post, $request->input('post_filter'));
                $imager_url = null;
                if ($request->input('imager_bool') && $request->input('imager1_filter') != null) {
                    $imager_html =  $this->api->html_second_floor($html_post, $request->input('post_filter'));
                    $imager_url =  $this->api->html_imager_url_one($imager_html, $request->input('imager1_filter'), 'jpg');
                    if ($imager_url == null) {
                        $imager_url =  $this->api->html_imager_url_one($imager_html, $request->input('imager1_filter'), 'png');
                    }
                    if ($request->input('imager_url') != null && $imager_url != null) {
                        $imager_url = $request->input('imager_url') . $imager_url;
                    }
                }
                $date = date("Y-m-d H:i:s");
                if ($request->input('event_date_filter') != null) {
                    $date =  $this->api->html_min_date($html_post, $request->input('event_date_filter'));

                    $date =  $this->api->tidyDate($date);
                }


                $text[] = [
                    'title' => $table['text'],
                    'body' => $post_text,
                    'imager' => $imager_url,
                    'url' => $table['url'],
                    'date'=>$date
                ];
            } else {
                $html_post = $this->api->getWebpage($table['url']);

                $post_text =  $this->api->html_text($html_post, $request->input('post_filter'));
                $imager_url = null;
                if ($request->input('imager_bool') && $request->input('imager1_filter') != null) {
                    $imager_html =  $this->api->html_second_floor($html_post, $request->input('post_filter'));
                    $imager_url =  $this->api->html_imager_url_one($imager_html, $request->input('imager1_filter'), 'jpg');
                    if ($imager_url == null) {
                        $imager_url =  $this->api->html_imager_url_one($imager_html, $request->input('imager1_filter'), 'png');
                    }
                    if ($request->input('imager_url') != null && $imager_url != null) {
                        $imager_url = $request->input('imager_url') . $imager_url;
                    }
                }
                $date = date("Y-m-d H:i:s");
                if ($request->input('event_date_filter') != null) {
                    $date =  $this->api->html_min_date($html_post, $request->input('event_date_filter'));

                    $date =  $this->api->tidyDate($date);
                }
                $text[] = [
                    'title' => $table['text'],
                    'body' => $post_text,
                    'imager' => $imager_url,
                    'url' => $table['url'],
                    'date'=>$date
                ];
            }
        }
        return [
            'list_data' => $tables,
            'text_data' => $text,
        ];
    }
}
