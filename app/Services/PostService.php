<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Post;
use DOMDocument;
use DOMXPath;

use App\Api\Api;

class PostService
{
    protected $api;
    public function __construct()
    {
        $this->api = new Api();
    }

    public function PostData(Request $request)
    {


//         $html = $this->api->getWebpage('https://www.cultural.pthg.gov.tw/News_Content_ForCul.aspx?n=8063759E00B599E4&sms=6926A0EAA361A4C7&s=9A1F79505B2EA53D');
// return strip_tags($html);
//         // 創建 DOMDocument 實例並加載 HTML 內容
//         $dom = new DOMDocument();
//         $dom->loadHTML($html); // $html 是你要解析的 HTML 內容

//         // 創建 DOMXPath 實例
//         $xpath = new DOMXPath($dom);

//         // 使用 XPath 查詢獲取指定 id 的元素
//         $query = "//div[@id='ContentPlaceHolder1_divContent']";
//         $elements = $xpath->query($query);

//         // 提取元素中的文字內容
//         if ($elements->length > 0) {
//             $textContent = $elements->item(0)->textContent;
//             return $textContent;
//         } else {
//             return "未找到指定 id 的元素";
//         }
    }
}
