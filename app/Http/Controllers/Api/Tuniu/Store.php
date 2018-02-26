<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Lib\Tn\Result;
use App\Lib\Tn\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Store extends Tuniu
{
    public function getStore(Request $request)
    {

        $stores = \App\Model\Store::select('id as StoreCode',
            'type as StoreType',
            'name as Name',
            'city as CityCode',
            'location_name as Address',
            'phone as Telephone',
            'open_time as OpeningTime',
            'close_time as ClosingTime',
            'location_poi',
            'status as Status',
            'payment_method as PayMode',
            'diff_Store_rank as DiffStoreRank',
            'minimal_advance_booking_time as BookAdvanceHours'
            )->get();
        $reslist = [];

        foreach($stores as $store){
            $storeInfo = new StoreInfo();
            $storeInfo->setStatus($store->Status);
            $storeInfo->setAddress($store->Address);
            $storeInfo->setBookAdvanceHours($store->BookAdvanceHours);
            $storeInfo->setCityCode($store->CityCode);
            $storeInfo->setClosingTime($store->ClosingTime);
            $storeInfo->setOpeningTime($store->OpeningTime);
            $storeInfo->setDiffStoreRank($store->DiffStoreRank);
            $storeInfo->setLocation($store->location_poi);
            $storeInfo->setName($store->Name);
            $storeInfo->setPayMode($store->PayMode);
            $storeInfo->setStoreCode($store->StoreCode);
            $storeInfo->setStoreType($store->StoreType);
            $storeInfo->setTelephone($store->Telephone);
            $reslist[] = $storeInfo;
        }
        $root = 'GetStoreInfoResponse';
        $this->data = [
            'Result'=>new Result($reslist, 'Success'),
            'StoreInfoList'=>$reslist
        ];

        return $this->getResult($root);
    }
}
