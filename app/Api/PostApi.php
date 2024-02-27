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
     * 檢查post是否重複，不重複在建立
     *
     */
    public function repeat_postModel($title,$post_text,$post_url,$post_tab,$website_name,$website_url,$html_python_id,$area_id=0,$imager_title='',$imager1 = '')
    {
        $post = Post::where('title',$title)->first();
        if($post != null){
            return false;
        }else{
            $this->postModel($title,$post_text,$post_url,$post_tab,$website_name,$website_url,$html_python_id,$area_id,$imager_title,$imager1);
            return true;
        }

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
        return $results ?? [];
    }



    /**
     * 列表查詢文章流程
     *
     */
    public function post_text($texts,$htmlPython)
    {
        foreach ($texts as $text) {
            if ($htmlPython->connect_url != null) {
                $html_post = $this->getWebpage($htmlPython->connect_url . $text['url']);

                $post_text =  $this->html_text($html_post, $htmlPython->post_filter);
                $this->repeat_postModel($text['text'],$post_text,$htmlPython->connect_url . $text['url'],'',$htmlPython->name,$htmlPython->url,$htmlPython->id,$htmlPython->area_id);

            } else {
                $html_post = $this->getWebpage($text['url']);

                $post_text =  $this->html_text($html_post, $htmlPython->post_filter);
                $this->repeat_postModel($text['text'],$post_text,$text['url'],'',$htmlPython->name,$htmlPython->url,$htmlPython->id,$htmlPython->area_id);

            }
        }
    }

}
