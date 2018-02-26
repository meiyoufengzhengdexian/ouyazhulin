<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 10:33
 */

namespace App\Http\Controllers\Api\Tuniu;


class ProductSummary
{
    public $VehicleCode;
    public $CouponPrice;
    public $TotalPrice;
    public $RentalPeriod;
    public $PickupStoreCode;
    public $ReturnStoreCode;
    public $Extra;

    /**
     * @return mixed
     */
    public function getVehicleCode()
    {
        return $this->VehicleCode;
    }

    /**
     * @param mixed $VehicleCode
     */
    public function setVehicleCode($VehicleCode)
    {
        $this->VehicleCode = $VehicleCode;
    }

    /**
     * @return mixed
     */
    public function getCouponPrice()
    {
        return $this->CouponPrice;
    }

    /**
     * @param mixed $CouponPrice
     */
    public function setCouponPrice($CouponPrice)
    {
        $this->CouponPrice = $CouponPrice;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->TotalPrice;
    }

    /**
     * @param mixed $TotalPrice
     */
    public function setTotalPrice($TotalPrice)
    {
        $this->TotalPrice = $TotalPrice;
    }

    /**
     * @return mixed
     */
    public function getRentalPeriod()
    {
        return $this->RentalPeriod;
    }

    /**
     * @param mixed $RentalPeriod
     */
    public function setRentalPeriod($RentalPeriod)
    {
        $this->RentalPeriod = $RentalPeriod;
    }

    /**
     * @return mixed
     */
    public function getPickupStoreCode()
    {
        return $this->PickupStoreCode;
    }

    /**
     * @param mixed $PickupStoreCode
     */
    public function setPickupStoreCode($PickupStoreCode)
    {
        $this->PickupStoreCode = $PickupStoreCode;
    }

    /**
     * @return mixed
     */
    public function getReturnStoreCode()
    {
        return $this->ReturnStoreCode;
    }

    /**
     * @param mixed $ReturnStoreCode
     */
    public function setReturnStoreCode($ReturnStoreCode)
    {
        $this->ReturnStoreCode = $ReturnStoreCode;
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->Extra;
    }

    /**
     * @param mixed $Extra
     */
    public function setExtra($Extra)
    {
        $this->Extra = $Extra;
    }

}