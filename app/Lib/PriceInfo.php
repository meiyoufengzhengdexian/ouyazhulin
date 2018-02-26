<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 11:08
 */

namespace App\Lib;


use App\Model\Setting;
use DateTime;

class PriceInfo
{
    public $priceupStore;
    public $returnStore;
    public $pickupTime;
    public $returnTime;
    public $carPatt;

    /**
     * PriceInfo constructor.
     * @param $priceupStore
     * @param $returnStore
     * @param $pickupTime
     * @param $returnTime
     */
    public function __construct($priceupStore, $returnStore, $pickupTime, $returnTime, $carPatt)
    {
        $this->priceupStore = $priceupStore;
        $this->returnStore = $returnStore;
        $this->pickupTime = $pickupTime;
        $this->returnTime = $returnTime;
        $this->carPatt = $carPatt;
    }

    /**
     * 返回租车天数
     * 不足4小时 按照超小时计算
     * 4小时以上按照一天计算
     */
    public function getDiff($start_time = null, $end_time = null)
    {
        $datetime1 = new DateTime($start_time ? $start_time : $this->pickupTime);
        $datetime2 = new DateTime($end_time ? $end_time : $this->returnTime);

        $h = intval(Setting::getOne('h'));

        $interval = $datetime1->diff($datetime2);

        $interval->day = $interval->d;
        // 29 小时  1天 + 半天 + 1小时
        if ($interval->h >= $h / 2) {
            $interval->day = $interval->d + 0.5;
            $interval->h = $interval->h-12 < 0
                ? 0
                : $interval->h-12;
        }

        return $interval;
    }

    public function getDay($start_time = null, $end_time = null)
    {
        $datetime1 = new DateTime($start_time ? $start_time : date('Y-m-d', strtotime($this->pickupTime)));
        $datetime2 = new DateTime($end_time ? $end_time : date('Y-m-d', strtotime($this->returnTime)));
        $day = (int)$datetime1->diff($datetime2)->format('%a');
        return $day == 0 ? 1: $day;
    }

    public function getHours()
    {
        $pickUptime = strtotime($this->pickupTime);
        $returnTime = strtotime($this->returnTime);
        return round(($returnTime - $pickUptime) / 3600, 2);
    }


    /**
     * 创建唯一标识符
     */
    public function createMark($pickUpStore, $returnStore)
    {
        $str = json_encode($this) . $pickUpStore . $returnStore;
        return md5($str);
    }

    /**
     * @return mixed
     */
    public function getCarPatt()
    {
        return $this->carPatt;
    }

    /**
     * @param mixed $carPatt
     */
    public function setCarPatt($carPatt)
    {
        $this->carPatt = $carPatt;
    }

    /**
     * @return mixed
     */
    public function getReturnStore()
    {
        return $this->returnStore;
    }

    /**
     * @param mixed $returnStore
     */
    public function setReturnStore($returnStore)
    {
        $this->returnStore = $returnStore;
    }

    /**
     * @return mixed
     */
    public function getPickupTime()
    {
        return $this->pickupTime;
    }

    /**
     * @param mixed $pickupTime
     */
    public function setPickupTime($pickupTime)
    {
        $this->pickupTime = $pickupTime;
    }


    /**
     * @param mixed $returnTime
     */
    public function setReturnTime($returnTime)
    {
        $this->returnTime = $returnTime;
    }

    /**
     * @return mixed
     */
    public function getPriceupStore()
    {
        return $this->priceupStore;
    }

    /**
     * @return mixed
     */
    public function getReturnTime()
    {
        return $this->returnTime;
    }


    /**
     * @return mixed
     */
    public function getPickupStore()
    {
        return $this->priceupStore;
    }

    /**
     * @param mixed $priceupStore
     */
    public function setPriceupStore($priceupStore)
    {
        $this->priceupStore = $priceupStore;
    }


}