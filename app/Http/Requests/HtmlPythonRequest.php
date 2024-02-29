<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HtmlPythonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [


            'name' => 'required|string|nullable',
            'title_filter' => 'required|string|nullable',
            'body_filter' => 'required|string|nullable',
            'imager1_filter' => 'sometimes|string|nullable',
            'url' => 'required|string|nullable',
            'connect_url' => 'sometimes|string|nullable',
            'post_filter' => 'required|string|nullable',
            'table_page' => 'sometimes|string|nullable',
            'page_bool' => 'required|boolean',
            'page' => 'sometimes|integer',
            'enble' => 'required|boolean',
            'imager_url' => 'sometimes|string|nullable',
            'imager_bool' => 'required|boolean',
            'area_id' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'title_filter'=>'列表的第二層定位',
            'body_filter'=>'列表的第一層定位',
            'connect_url'=>'文章的url',
            'url'=>'列表的url',
            'table_page'=>'要翻頁的變數代碼，沒有就null',
            'page_bool'=>'要不要翻頁',
            'page'=>'要翻幾頁',
            'enble'=>'是否啟用',
            'imager_url'=>'圖片的開頭url',
            'imager_bool'=>'要不要爬圖片',
        ];
    }
}
