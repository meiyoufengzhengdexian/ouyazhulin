<?php

namespace App\Http\Controllers\Api\Tuniu;

use App\Exceptions\ProductSummaryNotFoundException;
use App\Lib\PriceInfo;
use App\Lib\Tn\AdditionalFee;
use App\Lib\Tn\AdditionalService;
use App\Lib\Tn\DetailFee;
use App\Lib\Tn\ProductInfo;
use App\Lib\Tn\Result;
use App\Model\Additional_service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class Product extends Tuniu
{
    /**
     *
     */
    public function getProduct(Request $request)
    {
        $priceInfo = new \App\Model\PriceInfo();
        $input = $this->getInput();
        $extra = $input->Extra->__toString();
        $productSummary = unserialize(Redis::get($extra));

        if(!$productSummary){
            throw new ProductSummaryNotFoundException();
        }

        $productInfo = new ProductInfo();
        $totalPrice =$productSummary->getPrice();
        $priceInfo->price = $totalPrice;

        $productInfo->setVehicleCode($productSummary->getVehicleCode());
        $productInfo->setActualTotalAmount($totalPrice);
        $productInfo->setOriginalTotalAmount($totalPrice);
        $productInfo->setCouponAmount(0);
        $productInfo->setRentalPeriod($productSummary->getRentalPeriod());

        /**
         * 服务费必须有， 其他费用看配置， 不显示的全部算到基础服务费中
         */
        $detailFeeEntry = $productSummary->getDetailFee()->getList();

        $priceInfo->service_fee = $productSummary->getDetailFee()->serviceFee->getPrice();

        $showPrice = 0;
        $showList = [];


        foreach($detailFeeEntry as $serviceFee){
            if($serviceFee->show){  //基础费用不在内， 用来填不显示的坑
                if($serviceFee->getPrice() <= 0){
                    continue;
                }
                $showPrice += $serviceFee->getPrice();
                $DetailFee = new DetailFee();
                $DetailFee->setName($serviceFee->name);
                $DetailFee->setCode($serviceFee->code);
                $DetailFee->setUnitPrice($serviceFee->getPrice());
                $DetailFee->setUnit('全程');
                $DetailFee->setQuantity($serviceFee->getNum());
                $DetailFee->setAmount($serviceFee->getPrice());
                $showList[] = $DetailFee;
            }
        }

        $deffFee = $totalPrice - $showPrice;
        $priceInfo->basic_service_fee =  $deffFee;

        $DetailFee = new DetailFee();
        $DetailFee->setName('基础服务费');
        $DetailFee->setCode('基础服务费');
        $DetailFee->setUnitPrice($totalPrice - $showPrice);
        $DetailFee->setUnit('全程');
        $DetailFee->setQuantity(1);
        $DetailFee->setAmount($deffFee);

        $showList[] = $DetailFee;

        $productInfo->setDetailFees($showList);
        // 费用明细结束

        $AdditionalServices = [];

        $price = $productSummary->getDetailFee()->getPriceEntry();

        $price->getAdditional;
        $PriceAdditionalFees = Additional_service::where('type', 0)->get();

        foreach($AdditionalServices as $af){
            $adEntry = new AdditionalService();
            $adEntry->setCode($af->name);
            $adEntry->setName($af->name);
            $adEntry->setUnitPrice($af->price);
            $adEntry->setUnit('个');
            $adEntry->setQuantity(1);
            $adEntry->setAmount($af->price * $adEntry->getQuantity());
            $AdditionalServices[] = $adEntry;
        }

        foreach($PriceAdditionalFees as $af) {
            $adEntry = new AdditionalService();
            $adEntry->setCode($af->name);
            $adEntry->setName($af->name);
            $adEntry->setUnitPrice($af->price);
            $adEntry->setUnit('个');
            $adEntry->setQuantity(1);
            $adEntry->setAmount($af->price * $adEntry->getQuantity());
            $AdditionalServices[] = $adEntry;
        }

        //增值服务结束
        $productInfo->setAdditionalServices($AdditionalServices);

        //超小时费，超公里费，预授权，押金，违章押金
        $AdditionalFees = [];
        $chaoxiaoshi = new AdditionalFee();
        $chaoxiaoshi->setCode('超小时费');
        $chaoxiaoshi->setName('超小时费');
        $chaoxiaoshi->setUnit('小时');
        $chaoxiaoshi->setUnitPrice($price->ultra_hour_fee);
        $AdditionalFees[] = $chaoxiaoshi;

        $chaogongli = new AdditionalFee();
        $chaogongli->setCode('超公里费');
        $chaogongli->setName('超公里费');
        $chaogongli->setUnit('km');
        $chaogongli->setUnitPrice($price->ultra_km_fee);
        $AdditionalFees[] = $chaogongli;

        $yajin = new AdditionalFee();
        $yajin->setCode('押金/预授权');
        $yajin->setName('押金/预授权');
        $yajin->setUnit('全程');
        $yajin->setUnitPrice($price->pre_authorization_fee);
        $AdditionalFees[] = $yajin;

        $weizhang = new AdditionalFee();
        $weizhang->setCode('违章押金');
        $weizhang->setName('违章押金');
        $weizhang->setUnit('全程');
        $weizhang->setUnitPrice($price->Illegal_deposit);

        $AdditionalFees[] = $weizhang;

        $productInfo->setAdditionalFees($AdditionalFees);
        //附加费用结束
        $this->data = [
            'Result'=>new Result(true),
            'ProductInfo'=> $productInfo
        ];

        $priceInfo->ultra_hour_fee = $price->ultra_hour_fee;
        $priceInfo->ultra_km_fee = $price->ultra_km_fee;
        $priceInfo->pre_authorization_fee = $price->pre_authorization_fee;
        $priceInfo->Illegal_deposit = $price->Illegal_deposit;
        $priceInfo->off_site_fee = $price->off_site_fee;
        $priceInfo->night_give_fee = $price->night_give_fee;
        $priceInfo->night_return_fee = $price->night_return_fee;
        $priceInfo->night_start_time = $price->night_start_time;
        $priceInfo->night_end_time = $price->night_end_time;
        $priceInfo->platform = 1;
        $productSummary->priceExt = $priceInfo;
        Redis::SETEX($extra, 3600 * 4, serialize($productSummary));

        return $this->getResult('ProductResponse');
    }
}
