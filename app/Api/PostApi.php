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
    public function postModel($title,$post_text,$post_url,$post_tab,$website_name,$website_url,$imager_title,$imager1 = '',$area_id=0)
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
        $post->save();

    }

    /**
     * 解析html原始碼
     *
     */
    public function html_text($html,$filter)
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

}
