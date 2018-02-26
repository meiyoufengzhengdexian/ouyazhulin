<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Lib\Tn\CityInfo;
use App\Lib\Tn\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class City extends Tuniu
{
    //4.1 获取城市信息
    public function getCity()
    {
        $citys = \App\Model\City::select('code', 'name')->get();
        $list = [];
        foreach($citys as $city){
            $list[] = new CityInfo($city->code, $city->name);
        }
        $this->data = [
            'Result'=> new Result($list),
            'CityInfoList'=>$list
        ];
        // root as xml root tag
        return $this->getResult('GetCityInfoResponse');
    }
}
