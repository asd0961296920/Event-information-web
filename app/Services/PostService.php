<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Post;
use DOMDocument;
use DOMXPath;
use App\Api\Api;
use App\Api\PostApi;
use Symfony\Component\DomCrawler\Crawler;
class PostService 
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api();

    }

    public function PostData(Request $request)
    {
        $html = $this->api->getWebpage('https://pthg.tainanoutlook.com/activity/408252618');

        $crawler = new Crawler($html);
        $filteredContent = $crawler->filter('.field-item');
        $text = '';
        // 循环输出所有匹配的内容
        foreach ($filteredContent as $contentNode) {
            $text .= $contentNode->nodeValue . PHP_EOL;
        }

        
        
        $post = new Post();
        $post->post_text = $text;
        $post->save();
        return $text;

    }
}
