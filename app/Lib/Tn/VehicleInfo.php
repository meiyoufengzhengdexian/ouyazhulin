<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 14:04
 */

namespace App\Lib\Tn;


use App\Model\Car_type;
use App\Model\Transmission;

class VehicleInfo
{
    public $VehicleCode;
    public $VehicleGroupName;
    public $Name;
    public $Displacement;
    public $TransmissionType;
    public $PassengerNumber;
    public $CarriageNumber;
    public $Image;
    public $VehicleBrand;

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
    public function getVehicleGroupName()
    {
        return $this->VehicleGroupName;
    }

    /**
     * @param mixed $VehicleGroupName
     */
    public function setVehicleGroupName($VehicleGroupName)
    {
        $this->VehicleGroupName = $VehicleGroupName;
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
    public function getDisplacement()
    {
        return $this->Displacement;
    }

    /**
     * @param mixed $Displacement
     */
    public function setDisplacement($Displacement)
    {
        $this->Displacement = $Displacement;
    }

    /**
     * @return mixed
     */
    public function getTransmissionType()
    {
        return $this->TransmissionType;
    }

    /**
     * @param mixed $TransmissionType
     */
    public function setTransmissionType($TransmissionType)
    {
        $this->TransmissionType = Transmission::id2Code($TransmissionType);
    }

    /**
     * @return mixed
     */
    public function getPassengerNumber()
    {
        return $this->PassengerNumber;
    }

    /**
     * @param mixed $PassengerNumber
     */
    public function setPassengerNumber($PassengerNumber)
    {
        $this->PassengerNumber = $PassengerNumber;
    }

    /**
     * @return mixed
     */
    public function getCarriageNumber()
    {
        return $this->CarriageNumber;
    }

    /**
     * @param mixed $CarriageNumber
     */
    public function setCarriageNumber($CarriageNumber)
    {
        $this->CarriageNumber = $CarriageNumber;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * @param mixed $Image
     */
    public function setImage($Image)
    {
        $this->Image = url($Image);
    }

    /**
     * @return mixed
     */
    public function getVehicleBrand()
    {
        return $this->VehicleBrand;
    }

    /**
     * @param mixed $VehicleBrand
     */
    public function setVehicleBrand($VehicleBrand)
    {
        $this->VehicleBrand = $VehicleBrand;
    }


}