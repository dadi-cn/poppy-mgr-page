<?php
declare(strict_types = 1);

namespace Poppy\Area\Commands;

use Illuminate\Console\Command;
use Poppy\Area\Models\AreaContent;
use Poppy\Core\Redis\RdsDb;

class ImportCommand extends Command
{
    protected $name = 'py-area:import';


    private $rds;

    public function handle()
    {
        $this->rds = new RdsDb();

        $this->initProvince();
        $this->initCity();
        $this->initCounty();
    }

    public function initProvince(): void
    {
        $path      = poppy_path('poppy.area', 'resources/def/province.json');
        $content   = app('files')->get($path);
        $provinces = json_decode($content, true);

        foreach ($provinces as $pro) {
            if (!AreaContent::where('code', $pro['id'])->exists()) {
                AreaContent::create([
                    'code'     => $pro['id'],
                    'title'    => $pro['name'],
                    'level'    => AreaContent::LEVEL_PROVINCE,
                    'children' => '',
                ]);
            }
        }
        $kv = AreaContent::whereRaw('right(code, 10) = "0000000000"')->pluck('id', 'code');
        $this->rds->hMSet($this->ckProvince(), $kv->toArray());
    }

    public function initCity()
    {
        $path      = poppy_path('poppy.area', 'resources/def/city.json');
        $content   = app('files')->get($path);
        $provinces = json_decode($content, true);
        foreach ($provinces as $province_code => $city) {
            $provinceId = $this->rds->hGet($this->ckProvince(), $province_code);
            $insert     = [];
            foreach ($city as $ci) {
                $insert[] = [
                    'code'      => $ci['id'],
                    'parent_id' => $provinceId,
                    'title'     => $ci['name'],
                    'level'     => AreaContent::LEVEL_CITY,
                    'children'  => '',
                ];
            }
            if (AreaContent::where('parent_id', $provinceId)->exists()) {
                continue;
            }
            if(count($insert)){
                AreaContent::where('id', $provinceId)->update([
                    'has_child' => 1,
                ]);
                AreaContent::insert($insert);
            }
        }
        $kv = AreaContent::whereRaw('right(code, 8) = "00000000"')->where('parent_id', '!=', 0)->pluck('id', 'code');
        $this->rds->hMSet($this->ckCity(), $kv->toArray());
    }

    public function initCounty()
    {
        $path    = poppy_path('poppy.area', 'resources/def/county.json');
        $content = app('files')->get($path);
        $cities  = json_decode($content, true);
        foreach ($cities as $city_code => $counties) {
            $cityId = $this->rds->hGet($this->ckCity(), $city_code);
            $insert = [];
            foreach ($counties as $ci) {
                $insert[] = [
                    'code'      => $ci['id'],
                    'parent_id' => $cityId,
                    'title'     => $ci['name'],
                    'level'     => AreaContent::LEVEL_COUNTY,
                    'children'  => '',
                ];
            }
            if (AreaContent::where('parent_id', $cityId)->exists()) {
                continue;
            }
            if(count($insert)){
                AreaContent::where('id', $cityId)->update([
                    'has_child' => 1,
                ]);
                AreaContent::insert($insert);
            }
        }
    }

    private function ckProvince(): string
    {
        return 'py-area:import-province';
    }

    private function ckCity(): string
    {
        return 'py-area:import-city';
    }
}