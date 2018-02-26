<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 14:06
 */

namespace App\Lib\Tn;


class AdditionalFee
{
    public $Code;
    public $Name;
    public $UnitPrice;
    public $Unit;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @param mixed $Code
     */
    public function setCode($Code)
    {
        $this->Code = $Code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->UnitPrice;
    }

    /**
     * @param mixed $UnitPrice
     */
    public function setUnitPrice($UnitPrice)
    {
        $this->UnitPrice = $UnitPrice;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->Unit;
    }

    /**
     * @param mixed $Unit
     */
    public function setUnit($Unit)
    {
        $this->Unit = $Unit;
    }
}