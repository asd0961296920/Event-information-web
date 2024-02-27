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
    public function postModel($title,$post_text,$post_url,$post_tab,$website_name,$website_url,$html_python_id,$area_id=0,$imager_title='',$imager1 = '')
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
        $post->save();

    }

    /**
     * 解析html原始碼輸出文字
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

    /**
     * 解析html原始碼輸出標題和url
     *
     */
    public function html_url($html,$filter,$title_filter)
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
            if($urls != [] && $urls != null){
                $urls = $urls[0];
            }else{
                $urls = '';
            }


            $results[] = ['text' => $text, 'url' => $urls];
        }

        }
        return $results;
    }

}
