<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 11:25
 */

namespace App\Lib;


class PriceResult
{
    public $DetailFee; //价格明细列表
    public $AdditionalService; //增值服务列表
    public $AdditionalFee;//  附加费用列表

    /**
     * PriceResult constructor.
     * @param $DetailFee
     * @param $AdditionalService
     * @param $AdditionalFee
     */
    public function __construct($DetailFee, $AdditionalService, $AdditionalFee)
    {
        $this->DetailFee = $DetailFee;
        $this->AdditionalService = $AdditionalService;
        $this->AdditionalFee = $AdditionalFee;
    }


}