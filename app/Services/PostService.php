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
    public function PostDataMain(Request $request)
    {
        $processes = [];
        $pid1 = pcntl_fork();
        
        if ($pid1 == -1) {
            die('Could not fork.');
        } elseif ($pid1) {
            // 父進程
            $processes[] = $pid1;
        } else {
        
            //以下是該子進程主要邏輯
            // $response = response()->json(['狀態'=>'成功'])->setStatusCode(200);
            // $response->send();
            // exit();
            return '成功';
        }
        
        
        $pid2 = pcntl_fork();
        
        if ($pid2 == -1) {
            die('Could not fork.');
        } elseif ($pid2) {
            // 父進程
            $processes[] = $pid2;
        } else {
        
            $this->PostData($request);
        
            exit();
        }
        
        // 父進程等待子進程完成
        foreach ($processes as $pid) {
            pcntl_waitpid($pid, $status);
        }

    }

    public function PostDataMainOne(Request $request,$id)
    {
        $processes = [];
        $pid1 = pcntl_fork();
        
        if ($pid1 == -1) {
            die('Could not fork.');
        } elseif ($pid1) {
            // 父進程
            $processes[] = $pid1;
        } else {
        
            //以下是該子進程主要邏輯
            // $response = response()->json(['狀態'=>'成功'])->setStatusCode(200);
            // $response->send();
            // exit();
            return '成功';
        }
        
        
        $pid2 = pcntl_fork();
        
        if ($pid2 == -1) {
            die('Could not fork.');
        } elseif ($pid2) {
            // 父進程
            $processes[] = $pid2;
        } else {
        
            $this->PostDataOne($request,$id);
        
            exit();
        }
        
        // 父進程等待子進程完成
        foreach ($processes as $pid) {
            pcntl_waitpid($pid, $status);
        }

    }


    public function PostData(Request $request)
    {
        $htmlPythons = HtmlPython::get();

        foreach ($htmlPythons as $htmlPython) {

            try {


                if ($htmlPython->enble) {
                    $this->api->log_request([$htmlPython->url],'PostData',$htmlPython->url,[],'網站爬蟲列表(城市代碼：' .$htmlPython->area_id .')');
                    usleep(100000);
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
                    $this->api->log_response($texts,'PostData',200,'網站爬蟲列表',[]);
                }
            } catch (\Exception $e) {
            }
        }



        return $texts ?? 'ok';
    }


    public function PostDataOne(Request $request,$id)
    {
        $htmlPython = HtmlPython::where('id' == $id)->first();

            try {


                if ($htmlPython->enble) {
                    $this->api->log_request([$htmlPython->url],'PostData',$htmlPython->url,[],'網站爬蟲列表(城市代碼：' .$htmlPython->area_id .')');
                    usleep(100000);
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
                    $this->api->log_response($texts,'PostData',200,'網站爬蟲列表',[]);
                }
            } catch (\Exception $e) {
            }




        return $texts ?? 'ok';
    }


    public function PostText(Request $request)
    {
        $html = $this->api->getWebpage($request->input('url'));
        if($request->input('tag') == 'title'){
            return $this->api->html_url($html, $request->input('body_filter'), $request->input('title_filter'));
        }
        if($request->input('tag') == 'text'){
            return $this->api->html_text($html, $request->input('body_filter'));
        }
        if($request->input('tag') == 'imager'){
            $data =  $this->api->html_imager_url_one($html, $request->input('body_filter'), 'jpg');
            if ($data == null) {
                $data =  $this->api->html_imager_url_one($html, $request->input('body_filter'), 'png');
            }
            return $data;
        }
        if($request->input('tag') == 'date'){

            $data =  $this->api->html_min_date($html, $request->input('body_filter'));

            $data =  $this->api->tidyDate($data);
            return $data;

        }

    }


    public function GetData(Request $request)
    {

        $posts = Post::query();
        if($request->input('city_id')){
            $posts->where('area_id', $request->input('city_id'));
        }
        if ($request->input('keyword')) {
            $keyword = '%' . $request->input('keyword') . '%';
            $posts->where('title', 'like', $keyword);
        }

        if($request->input('year')){
          $posts->whereYear('event_date', $request->input('year'));
        }
        if($request->input('moth')){
            $posts->whereMonth('event_date', $request->input('moth'));
        }

        $perPage = $request->input('number');
        $page = $request->input('page');
        
        $posts = $posts->with(['html_python', 'area'])
            ->orderBy('event_date', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
        
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
            usleep(100000);
            if ($request->input('connect_url') != null) {
                $html_post = $this->api->getWebpage($request->input('connect_url') . $table['url']);

                $post_text =  $this->api->html_text($html_post, $request->input('post_filter'));
                $imager_url = null;
                if ($request->input('imager_bool') && $request->input('imager1_filter') != null) {
                    $imager_html =  $this->api->html_second_floor($html_post, $request->input('post_filter'));
                    $imager_url =  $this->api->html_imager_url_one($html_post, $request->input('imager1_filter'), 'jpg');
                    if ($imager_url == null) {
                        $imager_url =  $this->api->html_imager_url_one($html_post, $request->input('imager1_filter'), 'png');
                    }
                    if ($request->input('imager_url') != null && $imager_url != null) {
                        $imager_url = $request->input('imager_url') . $imager_url;
                    }
                }
                $date = null;
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
                    $imager_url =  $this->api->html_imager_url_one($html_post, $request->input('imager1_filter'), 'jpg');
                    if ($imager_url == null) {
                        $imager_url =  $this->api->html_imager_url_one($html_post, $request->input('imager1_filter'), 'png');
                    }
                    if ($request->input('imager_url') != null && $imager_url != null) {
                        $imager_url = $request->input('imager_url') . $imager_url;
                    }
                }
                $date = null;
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
    //測試用
    public function PostText123(Request $request)
    {
        $html_post = $this->api->getWebpage("https://www.twmarket.tw/?p=48907");
        $imager_url = null;

        if ($request->input('imager_bool') && $request->input('imager1_filter') != null) {
            $imager_html =  $this->api->html_second_floor($html_post, $request->input('post_filter'));
            // return $imager_html ;
            $imager_url =  $this->api->html_imager_url_one($html_post, $request->input('imager1_filter'), 'jpg');
            // return $imager_url ;
            if ($imager_url == null) {
                $imager_url =  $this->api->html_imager_url_one($imager_html, $request->input('imager1_filter'), 'png');
            }
            if ($request->input('imager_url') != null && $imager_url != null) {
                $imager_url = $request->input('imager_url') . $imager_url;
            }
        }
        return $imager_url ;
    }
}
