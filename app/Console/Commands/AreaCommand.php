<?php

namespace App\Console\Commands;

use Illuminate\Http\Response;
use Illuminate\Console\Command;
use App\Logging\CloudLogger;
use App\Models\Area;
class AreaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'area';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增縣市資料';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Area::truncate();

        $datas = [
            "基隆市",
            "台北市",
            "新北市",
            "桃園市",
            "新竹市",
            "新竹縣",
            "苗栗縣",
            "台中市",
            "彰化縣",
            "南投縣",
            "雲林縣",
            "嘉義市",
            "嘉義縣",
            "台南市",
            "高雄市",
            "屏東縣",
            "台東縣",
            "花蓮縣",
            "澎湖縣",
            "金門縣",
            "連江縣"
        ];
        $this->area_model('台灣',null,0);
        foreach ($datas as $data) {
            $this->area_model( $data,0,1);
        }

    }



    public function area_model($city,$village,$upid)
    {
        $area = new Area();
        $area->nation = '台灣';
        $area->city = $city;
        $area->village = $village;
        $area->upid = $upid;
        $area->save();
    }


}
