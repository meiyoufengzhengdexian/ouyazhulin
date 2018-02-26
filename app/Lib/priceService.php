<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:14
 */

namespace App\Lib;

use App\Model\Price;

abstract class priceService implements Rend
{
    public $name = '服务费';
    protected $price;
    public $show = true;
    public $unitPrice = '项';
    public $code = '服务费';
    protected $num = 1;
    abstract public function getPrice();

    final public function getName()
    {
        return $this->name;
    }
    /**
     * @return int
     */
    public function getNum()
    {
        return $this->num;
    }
}