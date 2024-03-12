<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Api\PostApi;

class WebPython extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web_python';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '網頁爬蟲';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = new PostApi();
        $api->log_request([],'daily tasks','',[],'每日定時爬蟲');
        $request = new Request();
        $service = new PostService();

        $service->PostData($request);
        $api->log_response([],'daily tasks',200,'每日定時爬蟲',[]);
    }
}
