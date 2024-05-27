<?php

namespace App\Api;

use DOMDocument;
use DOMXPath;
use App\Models\Post;
use Symfony\Component\DomCrawler\Crawler;

class PostVerifyApi extends Api
{



    function __construct()
    {
    }



    /**
     * 清除多餘文章
     *
     */
    public function PostVerify($title)
    {


        if($title == "" || $title == null){
           return false;
        }
        if(strlen($title)<=5){
            return false;
        }

        // 检查字符串是否以"日期"开头
        if (mb_substr($title, 0, 2, 'UTF-8') == "日期") {
            return false;
        }

        return true;

    }



}
