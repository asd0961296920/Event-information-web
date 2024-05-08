<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Api\PostApi;

class Clearpost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Clearpost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除多餘文章';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = new PostApi();
        $api->log_request([],'Clearpost','',[],'清除多餘文章');


        $api->Clearpost();









        $api->log_response([],'Clearpost',200,'清除多餘文章',[]);
    }
}
