<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/6
 * Time: 10:24
 */

namespace App\Lib;


class AvailableStore
{
    public $store;
    public $carPatt;

    /**
     * AvailableStore constructor.
     * @param $store
     * @param $carPatt
     */
    public function __construct($store, $carPatt)
    {
        $this->store = $store;
        $this->carPatt = $carPatt;
    }

    /**
     * @return mixed
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $store
     */
    public function setStore($store)
    {
        $this->store = $store;
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
}