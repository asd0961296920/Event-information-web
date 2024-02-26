<?php

namespace App\Api;
use DOMDocument;
use DOMXPath;


class PostApi extends Api
{



    function __construct()
    {
    }

    /**
     * 解析html原始碼
     *
     */
    public function html_text($html)
    {
        // 初始化 DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html); // 使用 @ 符號來忽略可能的警告

        // 初始化 DOMXPath
        $xpath = new DOMXPath($dom);

        // 使用 XPath 查詢來定位特定的元素
        // 假設你想獲取 <title> 標籤中的文字
        $titleNode = $xpath->query('//title')->item(0); // 這將返回第一個符合的 <title> 元素

        // 獲取元素的文字內容
        $titleText = $titleNode->nodeValue;
    }
}
