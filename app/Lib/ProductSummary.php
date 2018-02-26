<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 16:45
 */

namespace App\Lib;


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
     * @var int 0 返回一天价格 1 返回实际价格
     */
    protected $type;

    /**
     * @var double 一天价格
     */
    protected $aDayPrice;

    /**
     * @var
     */
    protected $price;

    protected $cPrice;
    protected $acPrice;
    protected $priceInfo;
    /**
     * ProductSummary constructor.
     * @param $VehicleCode
     * @param $CouponPrice
     * @param $price
     * @param $RentalPeriod
     * @param $PickupStoreCode
     * @param $ReturnStoreCode
     * @param $Extra
     */

    protected $df;

    public function __construct($VehicleCode, $cPrice, $price,$RentalPeriod, $PickupStoreCode, $ReturnStoreCode, $Extra,  DetailFee $df, $priceinfo, $type = 1)
    {
        $this->VehicleCode = $VehicleCode;
        $this->cPrice = $cPrice;
        $this->setTotalPrice($price);
        $this->setCouponPrice($cPrice);
        $this->price = $price;
        $this->RentalPeriod = $RentalPeriod;
        $this->PickupStoreCode = $PickupStoreCode;
        $this->ReturnStoreCode = $ReturnStoreCode;
        $this->Extra = $Extra;
        $this->df = $df;
        $this->priceInfo = $priceinfo;
    }

    public function getPriceInfo()
    {
        return $this->priceInfo;
    }
    public function getDetailFee()
    {
        return $this->df;
    }
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
        $this->CouponPrice = round($CouponPrice, 1);
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
        $this->TotalPrice = round($TotalPrice, 1);
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

    /**
     * @param int $type
     */
    /**
     * @return float
     */
    public function getADayPrice()
    {
        return $this->aDayPrice;
    }

    /**
     * @param float $aDayPrice
     */
    public function setADayPrice($aDayPrice)
    {
        $this->aDayPrice = $aDayPrice;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCPrice()
    {
        return $this->cPrice;
    }

    /**
     * @param mixed $cPrice
     */
    public function setCPrice($cPrice)
    {
        $this->cPrice = $cPrice;
    }

    /**
     * @return mixed
     */
    public function getAcPrice()
    {
        return $this->acPrice;
    }

    /**
     * @param mixed $acPrice
     */
    public function setAcPrice($acPrice)
    {
        $this->acPrice = $acPrice;
    }
}