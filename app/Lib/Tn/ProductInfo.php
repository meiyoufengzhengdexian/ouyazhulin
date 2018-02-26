<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 14:03
 */

namespace App\Lib\Tn;


use App\Model\Additional_service;

class ProductInfo
{
    public $VehicleCode;
    public $ActualTotalAmount;
    public $OriginalTotalAmount;
    public $CouponAmount;
    public $RentalPeriod;
    public $DetailFees = [];
    public $AdditionalServices;
    public $AdditionalFees;

    public function addDetailFees(DetailFee $d)
    {
        $this->DetailFees[] = $d;
    }
    public function addAdditionalServices(AdditionalService $d)
    {
        $this->AdditionalServices[] = $d;
    }
    public function AdditionalFees(AdditionalFee $d){
        $this->AdditionalFees = $d;
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
    public function getActualTotalAmount()
    {
        return $this->ActualTotalAmount;
    }

    /**
     * @param mixed $ActualTotalAmount
     */
    public function setActualTotalAmount($ActualTotalAmount)
    {
        $this->ActualTotalAmount = $ActualTotalAmount;
    }

    /**
     * @return mixed
     */
    public function getOriginalTotalAmount()
    {
        return $this->OriginalTotalAmount;
    }

    /**
     * @param mixed $OriginalTotalAmount
     */
    public function setOriginalTotalAmount($OriginalTotalAmount)
    {
        $this->OriginalTotalAmount = $OriginalTotalAmount;
    }

    /**
     * @return mixed
     */
    public function getCouponAmount()
    {
        return $this->CouponAmount;
    }

    /**
     * @param mixed $CouponAmount
     */
    public function setCouponAmount($CouponAmount)
    {
        $this->CouponAmount = $CouponAmount;
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
    public function getDetailFees()
    {
        return $this->DetailFees;
    }

    /**
     * @param mixed $DetailFees
     */
    public function setDetailFees($DetailFees)
    {
        $this->DetailFees = $DetailFees;
    }

    /**
     * @return mixed
     */
    public function getAdditionalServices()
    {
        return $this->AdditionalServices;
    }

    /**
     * @param mixed $AdditionalServices
     */
    public function setAdditionalServices($AdditionalServices)
    {
        $this->AdditionalServices = $AdditionalServices;
    }

    /**
     * @return mixed
     */
    public function getAdditionalFees()
    {
        return $this->AdditionalFees;
    }

    /**
     * @param mixed $AdditionalFees
     */
    public function setAdditionalFees($AdditionalFees)
    {
        $this->AdditionalFees = $AdditionalFees;
    }


}