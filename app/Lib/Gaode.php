<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 11:33
 */

namespace App\Lib;


use App\Exceptions\GaodeException;
use App\Model\Store;
use Illuminate\Support\Facades\Redis;

class Gaode
{
    protected static $key = '94e4b1678c9c451bc9ba65778e7f378d';
    protected static $webkey = '3fe8d0a9d887b301d60acc1c7d2f0237';

    public static function getScriptTag()
    {
        $key = self::$key;
        return "<script src='https://webapi.amap.com/maps?v=1.3&key=$key'></script>";
    }

    public static function getKm($start, $end)
    {
        $result = json_decode(self::get('http://restapi.amap.com/v3/direction/driving',
            ['origin' => $start, 'extensions' => 'base', 'destination' => $end, 'destinationtype' => '2', 'key' => self::$webkey]));

        if (!$result || !isset($result->count) || $result->count == 0) {
            throw new GaodeException('高德获取信息失败');
        }

        $route = $result->route;
        $path = isset($route->paths[0]) ? $route->paths[0] : [];
        return round($path->distance / 1000);
    }

    public static function get($url, $param)
    {
        $parstr = http_build_query($param);
        $url = $url . '?' . $parstr;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        return curl_exec($curl);
    }

    public static function getStoreKm($store, $destStroe)
    {
        $km = Redis::get('store::km::'. $store. "::". $destStroe);

        if(!$km){

            $store = Store::find($store);
            $dest = Store::find($destStroe);

            try {
                $km = self::getKm($store->location_poi, $dest->location_poi);
            } catch (GaodeException $ge){
                return 0;
            }

            Redis::SETEX('store::km::'. $store->id. "::". $dest->id, 3600, $km);
        }

        return $km;
    }
}