<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Exceptions\CityNotFoundException;
use App\Lib\PriceInfo;
use App\Lib\Tn\Result;
use App\Lib\Tool;
use App\Model\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Search extends Tuniu
{
    public function search(Request $request)
    {

            $input = $this->getInput();
            $pickupCityCode = $input->PickupCityCode->__toString();
            $returnCityCode = $input->ReturnCityCode->__toString();
            $pickupStoreCodes = $input->PickupStoreCodes->string;
            $pickupDate = $input->PickupDate->__toString();
            $returnDate = $input->ReturnDate->__toString();
            $couponCode = $input->CouponCode->__toString();

            if ($pickupStoreCodes->count() == 0) {
                $city = \App\Model\City::whereCode($pickupCityCode)->first();
                if (!$city) {
                    throw new CityNotFoundException('cityCode: ' . $pickupCityCode);
                }
                $pickupStore = $city->getStores;
                $pickupStoreCodes = Tool::getIds($pickupStore)->toArray();
            } else {
                $tempList = [];
                foreach ($pickupStoreCodes as $code) {
                    $tempList[] = $code->__toString();
                }
                $pickupStoreCodes = $tempList;
            }

            $returnCity = \App\Model\City::whereCode($returnCityCode)->first();
            $returnStores = $returnCity->getStores;
            $returnStoreIds = Tool::getIds($returnStores)->toArray();

            $priceInfo = new PriceInfo($pickupStoreCodes, $returnStoreIds, $pickupDate, $returnDate, []);
            $calculateResult = Price::calculate($priceInfo);

            $list = [];
            foreach ($calculateResult as $item) {
                if ($item->getPrice() == 0) {
                    continue;
                }

                $productSummary = new ProductSummary();
                $productSummary->setVehicleCode($item->getVehicleCode());
                $productSummary->setCouponPrice($item->getPrice());
                $productSummary->setTotalPrice($item->getPrice());
                $productSummary->setRentalPeriod($item->getRentalPeriod());
                $productSummary->setPickupStoreCode($item->getPickupStoreCode());
                $productSummary->setReturnStoreCode($item->getReturnStoreCode());
                $productSummary->setExtra($item->getExtra());
                $list[] = $productSummary;
            }


            $root = 'SearchResponse';

            $this->data = [
                'Result' => new Result(true),
                'ProductList' => $list
            ];

            return $this->getResult($root);

        try { } catch (\Exception $e) {
            $this->data = [
                'Result' => new Result(false, $e->getMessage()),
                'ProductList' => []
            ];
            return $this->getResult();
        }
    }
}
