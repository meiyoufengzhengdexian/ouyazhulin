<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 10:35
 */

namespace App\Lib\Tn;


class CityInfo
{
    public $CityCode;
    public $Name;

    /**
     * CityInfo constructor.
     * @param $CityCode
     * @param $Name
     */
    public function __construct($CityCode, $Name)
    {
        $this->CityCode = $CityCode;
        $this->Name = $Name;
    }

}