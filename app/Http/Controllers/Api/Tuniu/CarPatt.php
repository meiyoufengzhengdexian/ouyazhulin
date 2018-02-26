<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Lib\Tn\Result;
use App\Lib\Tn\VehicleInfo;
use App\Model\Car_patt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarPatt extends Tuniu
{
    public function getCarPatt(Request $request)
    {
        $carPatt = Car_patt::select(
            'id as VehicleCode',
            'name as Name',
            'displacement as Displacement',
            'transmission as TransmissionType',
            'site as PassengerNumber',
            'model as CarriageNumber',
            'img as Image',
            'com as VehicleBrand',
            'com',
            'car_type'
        )->get();

        $list = [];
        foreach($carPatt as $cp){
            $vehicleInfo = new VehicleInfo();
            $vehicleInfo->setName($cp->Name);
            $vehicleInfo->setVehicleCode($cp->VehicleCode);
            $vehicleInfo->setVehicleGroupName($cp->car_type_name->name);
            $vehicleInfo->setDisplacement($cp->Displacement);
            $vehicleInfo->setTransmissionType($cp->TransmissionType);
            $vehicleInfo->setPassengerNumber($cp->PassengerNumber);
            $vehicleInfo->setCarriageNumber($cp->CarriageNumber);
            $vehicleInfo->setImage($cp->Image);
            $vehicleInfo->setVehicleBrand($cp->getComName->name);
            $list[] = $vehicleInfo;
        }

        $root = 'GetVehicleInfoResponse';
        $this->data = [
            'result'=>new Result($list),
            'VehicleInfoList'=>$list
        ];

        return $this->getResult($root);
    }
}
