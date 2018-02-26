<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 12:15
 */

namespace App\Lib\Tn;


use App\Model\City;
use App\Model\Pay_method;
use App\Model\Store;

class StoreInfo
{
    public $StoreCode;
    public $StoreType;
    public $Name;
    public $CityCode;
    public $Address;
    public $Telephone;
    public $OpeningTime;
    public $ClosingTime;
    public $Longitude;
    public $Latitude;
    public $Status;
    public $PayMode;
    public $DiffStoreRank;
    public $BookAdvanceHours;
    protected $Location;

    /**
     * @return mixed
     */
    public function getStoreCode()
    {
        return $this->StoreCode;
    }

    /**
     * @param mixed $StoreCode
     */
    public function setStoreCode($StoreCode)
    {
        $this->StoreCode = $StoreCode;
    }

    /**
     * @return mixed
     */
    public function getStoreType()
    {
        return $this->StoreType;
    }

    /**
     * @param mixed $StoreType
     */
    public function setStoreType($StoreType)
    {
        $this->StoreType = $StoreType;
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
    public function getCityCode()
    {
        return $this->CityCode;
    }

    /**
     * @param mixed $CityCode
     */
    public function setCityCode($CityCode)
    {

        $this->CityCode = City::id2Code($CityCode);
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param mixed $Address
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->Telephone;
    }

    /**
     * @param mixed $Telephone
     */
    public function setTelephone($Telephone)
    {
        $this->Telephone = $Telephone;
    }

    /**
     * @return mixed
     */
    public function getOpeningTime()
    {
        return $this->OpeningTime;
    }

    /**
     * @param mixed $OpeningTime
     */
    public function setOpeningTime($OpeningTime)
    {
        $this->OpeningTime = $OpeningTime;
    }

    /**
     * @return mixed
     */
    public function getClosingTime()
    {
        return $this->ClosingTime;
    }

    /**
     * @param mixed $ClosingTime
     */
    public function setClosingTime($ClosingTime)
    {
        $this->ClosingTime = $ClosingTime;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return mixed
     */
    public function getPayMode()
    {
        return $this->PayMode;
    }

    /**
     * @param mixed $PayMode
     */
    public function setPayMode($PayMode)
    {
        $this->PayMode = Pay_method::Id2Code($PayMode);
    }

    /**
     * @return mixed
     */
    public function getDiffStoreRank()
    {
        return $this->DiffStoreRank;
    }

    /**
     * @param mixed $DiffStoreRank
     */
    public function setDiffStoreRank($DiffStoreRank)
    {
        $this->DiffStoreRank = $DiffStoreRank;
    }

    /**
     * @return mixed
     */
    public function getBookAdvanceHours()
    {
        return $this->BookAdvanceHours;
    }

    /**
     * @param mixed $BookAdvanceHours 72:30:00
     */
    public function setBookAdvanceHours($BookAdvanceHours)
    {
        $this->BookAdvanceHours = Store::Time2Double($BookAdvanceHours);
    }

    /**
     * @param mixed $Location
     */
    public function setLocation($Location)
    {
        $this->Location = $Location;
        list($this->Latitude, $this->Longitude) = explode(',', $Location);
    }

}