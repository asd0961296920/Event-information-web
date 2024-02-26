<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;
use App\Logging\CloudLogger;
use App\Logging\LoggerParams;
use Monolog\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Api
{

    /**
     * 回傳前經過判斷
     *
     */
    public function return(mixed $data, int $state, string $action, string $apiType, array $input)
    {
        if ($state != 200) {
            $this->log_response($data, $apiType, $state, $action, $input);
            if (is_object($data)) {
                $response = response()->json($data)->setStatusCode($state);
                $response->send();
                exit;
            }
            $response = response()->json($data)->setStatusCode($state);
            $response->send();
            exit;
        }
        return $data;
    }

    /**
     * 紀錄log(request)
     *
     */
    public function log_request(mixed $data, string $apiType, string $url, array $header, string $action)
    {
        $loggerParams = new LoggerParams();
        $logger = new CloudLogger($data, $apiType, '', $loggerParams);
        $logger->logRequest($action, $url,  $header);
    }


    /**
     * 紀錄log(response)
     *
     */
    public function log_response(mixed $data, string $apiType, int $status, string $action, array $resquest)
    {
        if ($status != 200) {
            $loggerParams = new LoggerParams();
            $logger = new CloudLogger($resquest, $apiType, '', $loggerParams);
            $logger->logResponse($action, $status, $data, Logger::ERROR);
        } else {
            $loggerParams = new LoggerParams();
            $logger = new CloudLogger($resquest, $apiType, '', $loggerParams);
            $logger->logResponse($action, $status, $data);
        }
    }


    /**
     * 驗證連接是否正確（ＧＥＴ）
     *
     */
    public function token(array $headers, string $apiUrl)
    {
        try {
            $response = Http::withHeaders($headers)
                ->get($apiUrl);
            if ($response->status() === 200) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            // 捕获并处理任何异常
            throw $e;
        }
    }

    /**
     * 帶標頭的GET連接
     *
     */
    public function get(array $header, string $apiUrl, array $input, string $action, string $apiType)
    {
        for ($i = 0; $i < 4; $i++) {
            $this->log_request($input, $apiType, $apiUrl, $header, $action);
            $response = Http::withHeaders($header)
                ->get($apiUrl, $input);
            $this->log_response($response->json(), $apiType, $response->status(), $action, $input);

            if ($response->status() === 200) {
                return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
            }
        }
        return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
    }

    /**
     * 帶標頭的POST連接
     *
     */
    public function post(array $header, string $apiUrl, array $input, string $action, string $apiType)
    {
        for ($i = 0; $i < 4; $i++) {
            $this->log_request($input, $apiType, $apiUrl, $header, $action);
            $response = Http::withHeaders($header)
                ->post($apiUrl, $input);
            $this->log_response($response->json(), $apiType, $response->status(), $action, $input);
            if ($response->status() === 200) {
                return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
            }
        }
        return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
    }

    
    /**
     * 帶標頭的PUT連接
     *
     */
    public function put(array $header, string $apiUrl, array $input, string $action, string $apiType)
    {
        for ($i = 0; $i < 4; $i++) {
            $this->log_request($input, $apiType, $apiUrl, $header, $action);
            $response = Http::withHeaders($header)
                ->put($apiUrl, $input);
            $this->log_response($response->json(), $apiType, $response->status(), $action, $input);
            if ($response->status() === 200) {
                return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
            }
        }
        return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
    }


    /**
     * 帶標頭的PATCH連接
     *
     */
    public function patch(array $header, string $apiUrl, array $input, string $action, string $apiType)
    {
        for ($i = 0; $i < 4; $i++) {
            $this->log_request($input, $apiType, $apiUrl, $header, $action);
            $response = Http::withHeaders($header)
                ->patch($apiUrl, $input);
            $this->log_response($response->json(), $apiType, $response->status(), $action, $input);
            if ($response->status() === 200) {
                return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
            }
        }
        return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
    }

    /**
     * 帶標頭的DELETE連接
     *
     */
    public function delete(array $header, string $apiUrl, array $input, string $action, string $apiType)
    {
        for ($i = 0; $i < 4; $i++) {
            $this->log_request($input, $apiType, $apiUrl, $header, $action);
            $response = Http::withHeaders($header)
                ->delete($apiUrl, $input);
            $this->log_response($response->json(), $apiType, $response->status(), $action, $input);
            if ($response->status() === 200) {
                return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
            }
        }
        return $this->return(json_decode($response), $response->status(), $action, $apiType, $input);
    }

    public function error(mixed $error)
    {
        return response()->json(['success' => false, 'errors' => $error]);
    }

    //標準時區（+0）轉台灣時區（+8）
    public function time_UCT_in_TW(string $date)
    {
        // 創建 DateTime 物件，並指定原始時間和 UTC 時區
        $dateTimeUtc = new \DateTime($date, new \DateTimeZone('UTC'));

        // 將時區設定為 UTC+8
        $dateTimeUtc->setTimezone(new \DateTimeZone('Asia/Taipei'));

        // 取得轉換後的時間
        $dateTimeTaipei = $dateTimeUtc->format('Y-m-d H:i:s');
        return $dateTimeTaipei;
    }

    /**
     * 驗證request
     *
     */
    public function validator(Request $data,$class,string $apiType, string $action)
    {
        $validator = Validator::make($data->all(), $class->rules());

        if ($validator->fails()) {
            $this->log_response($validator->errors()->all(), $apiType, 400, $action, $data->all());
            http_response_code(400);
            $response = $this->error($validator->errors()->all());
            $response->send();
            exit;
        }
        return true;
    }



    /**
     * 日期中是否含有時分秒
     *
     */
    public function hasTime($dateString) {
        // 嘗試以特定格式解析日期時間
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
    
        // 如果解析成功，表示包含時分秒
        // 如果解析失敗，表示不包含時分秒
        return $dateTime !== false;
    }


    /**
     * 獲取網頁原始碼
     *
     */
    public function getWebpage(string $url)
    {
        // 使用 file_get_contents() 函式獲取網頁原始碼
        $response = file_get_contents($url);

        // 檢查是否發生錯誤
        if ($response === false) {
            return 'Error fetching URL';
        } else {
            // 輸出網頁原始碼
            return $response;
        }
    }
}
