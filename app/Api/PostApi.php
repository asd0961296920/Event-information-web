<?php

namespace App\Api;

use DOMDocument;
use DOMXPath;
use App\Models\Post;
use Symfony\Component\DomCrawler\Crawler;

class PostApi extends Api
{



    function __construct()
    {
    }


    /**
     * 建立post資料
     *
     */
    public function postModel($title, $post_text, $post_url, $post_tab, $website_name, $website_url, $html_python_id, $area_id = 0, $imager_title = '', $imager1 = '', $date)
    {
        $post = new Post();
        $post->title = $title;
        $post->post_text = $post_text;
        $post->post_url = $post_url;
        $post->post_tab = $post_tab;
        $post->website_name = $website_name;
        $post->website_url = $website_url;
        $post->imager_title = $imager_title;
        $post->imager1 = $imager1;
        $post->area_id = $area_id;
        $post->html_python_id = $html_python_id;
        $post->event_date = $date;

        $post->save();
    }

    /**
     * 檢查post是否重複，不重複在建立
     *
     */
    public function repeat_postModel($title, $post_text, $post_url, $post_tab, $website_name, $website_url, $html_python_id, $area_id = 0, $imager_title = '', $imager1 = '', $date)
    {
        $post = Post::where('title', $title)->first();
        if ($post != null) {
            return false;
        } else {
            $this->postModel($title, $post_text, $post_url, $post_tab, $website_name, $website_url, $html_python_id, $area_id, $imager_title, $imager1, $date);
            return true;
        }
    }

    /**
     * 檢查文章標題是否重複
     *
     */
    public function repeat($title)
    {
        $post = Post::where('title', $title)->first();
        if ($post != null) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 解析html原始碼輸出文字
     *
     */
    public function html_text($html, $filter)
    {

        $crawler = new Crawler($html);
        $filteredContent = $crawler->filter($filter);
        $text = '';
        // 循环输出所有匹配的内容
        foreach ($filteredContent as $contentNode) {
            $text .= $contentNode->nodeValue . PHP_EOL;
        }
        return $text;
    }


    /**
     * 解析html原始碼輸出最早的日期
     *
     */
    public function html_min_date($html, $filter)
    {
        $crawler = new Crawler($html);
        $filteredContent = $crawler->filter($filter);
        $minDate = null;
        // 循环输出所有匹配的日期
        foreach ($filteredContent as $contentNode) {
            $date = $contentNode->nodeValue;
            // 假設日期格式為YYYY-MM-DD
            if (preg_match('/\d{4}-\d{2}-\d{2}/', $date)) {
                if ($minDate === null || $date < $minDate) {
                    $minDate = $date;
                }
            }
        }
        return $minDate;
    }




    /**
     * 解析html原始碼輸出最早的日期
     *
     */
    public function tidyDate($text)
    {
        $pattern = '/\d{4}-\d{2}-\d{2}/'; // 匹配日期的正則表達式
        if (preg_match($pattern, $text, $matches)) {
            $date = $matches[0]; // 提取匹配的日期
            return $date; // 輸出：2024-03-20
        } else {
            return null;
        }
    }



    /**
     * 解析html原始碼輸出第一個圖片網址
     *
     */
    public function html_imager_url_one($html, $filter, $format)
    {
        try {
            $crawler = new Crawler($html);
            $filteredContent = $crawler->filter($filter);

            // // 選擇第一個匹配的內容
            // $firstContentNode = $filteredContent->first();

            foreach ($filteredContent as $filteredContents) {
                $imager_html = $filteredContents->ownerDocument->saveHTML($filteredContents);
                $imager_crawler = new Crawler($imager_html);
                // 從第一個匹配的內容中獲取符合指定格式的圖片標籤
                $firstImageNode = $imager_crawler->filter("img[src$='.{$format}']")->first();

                // 如果找到了符合格式的圖片標籤，返回它的src屬性值
                if ($firstImageNode->count() > 0) {
                    return $firstImageNode->attr('src');
                }
            }
        } catch (\Exception $e) {
        }
        return null;
    }

    /**
     * 過濾原始碼
     *
     */
    public function html_second_floor($html, $filter)
    {
        $crawler = new Crawler($html);
        $filteredContent = $crawler->filter($filter);
        $text = '';
        // 循环输出所有匹配的内容
        foreach ($filteredContent as $contentNode) {
            $text .= $contentNode->ownerDocument->saveHTML($contentNode);
        }
        return $text;
    }

    /**
     * 解析html原始碼輸出標題和url
     *
     */
    public function html_url($html, $filter, $title_filter)
    {
        $crawler = new Crawler($html);
        $filteredContent = $crawler->filter($filter);

        // 循环输出所有匹配的内容
        foreach ($filteredContent as $contentNode) {

            $table_html = $contentNode->ownerDocument->saveHTML($contentNode);
            $table_crawler = new Crawler($table_html);
            $tableContent = $table_crawler->filter($title_filter);
            foreach ($tableContent as $tableContents) {
                $tableContents_html = $tableContents->ownerDocument->saveHTML($tableContents);
                $tableContents_crawler = new Crawler($tableContents_html);

                $text = $tableContents->nodeValue;
                $text = str_replace("\n", "", $text);
                $urls = $tableContents_crawler->filter($title_filter)->filter('a')->extract(['href']);
                if ($urls != [] && $urls != null) {
                    $urls = $urls[0];
                } else {
                    $urls = '';
                }


                $results[] = ['text' => $text, 'url' => $urls];
            }
        }
        return $results ?? [];
    }



    /**
     * 列表查詢文章流程
     *
     */
    public function post_text($texts, $htmlPython)
    {

        foreach ($texts as $text) {
            try {
                if ($this->repeat($text['text'])) {


                    if ($htmlPython->connect_url != null) {
                        $this->log_request([], 'post_text', $htmlPython->connect_url . $text['url'], [], '網站爬蟲api文章');
                        $html_post = $this->getWebpage($htmlPython->connect_url . $text['url']);

                        $post_text =  $this->html_text($html_post, $htmlPython->post_filter);
                        $imager_url = null;
                        if ($htmlPython->imager_bool && $htmlPython->imager1_filter != null) {
                            $imager_html =  $this->html_second_floor($html_post, $htmlPython->post_filter);
                            $imager_url =  $this->html_imager_url_one($imager_html, $htmlPython->imager1_filter, 'jpg');
                            if ($imager_url == null) {
                                $imager_url =  $this->html_imager_url_one($imager_html, $htmlPython->imager1_filter, 'png');
                            }
                            if ($htmlPython->imager_url != null && $imager_url != null) {
                                $imager_url = $htmlPython->imager_url . $imager_url;
                            }
                        }
                        $date = null;
                        if ($htmlPython->event_date_filter != null) {
                            $date =  $this->html_min_date($html_post, $htmlPython->event_date_filter);

                            $date =  $this->tidyDate($date);
                        }



                        $this->repeat_postModel($text['text'], $post_text, $htmlPython->connect_url . $text['url'], '', $htmlPython->name, $htmlPython->url, $htmlPython->id, $htmlPython->area_id, null, $imager_url, $date);
                    } else {
                        $this->log_request([], 'post_text', $text['url'], [], '網站爬蟲api文章');
                        $html_post = $this->getWebpage($text['url']);

                        $post_text =  $this->html_text($html_post, $htmlPython->post_filter);
                        $imager_url = null;
                        if ($htmlPython->imager_bool && $htmlPython->imager1_filter != null) {
                            $imager_html =  $this->html_second_floor($html_post, $htmlPython->post_filter);
                            $imager_url =  $this->html_imager_url_one($imager_html, $htmlPython->imager1_filter, 'jpg');
                            if ($imager_url == null) {
                                $imager_url =  $this->html_imager_url_one($imager_html, $htmlPython->imager1_filter, 'png');
                            }
                            if ($htmlPython->imager_url != null && $imager_url != null) {
                                $imager_url = $htmlPython->imager_url . $imager_url;
                            }
                        }
                        $date = null;
                        if ($htmlPython->event_date_filter != null) {
                            $date =  $this->html_min_date($html_post, $htmlPython->event_date_filter);

                            $date =  $this->tidyDate($date);
                        }

                        $this->repeat_postModel($text['text'], $post_text, $text['url'], '', $htmlPython->name, $htmlPython->url, $htmlPython->id, $htmlPython->area_id, null, $imager_url, $date);
                        $this->log_response($post_text, 'post_text', 200, '網站爬蟲api文章', []);
                    }
                }
            } catch (\Exception $e) {
            }
        }
    }
}
