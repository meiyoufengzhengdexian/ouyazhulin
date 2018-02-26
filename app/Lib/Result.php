<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 11:33
 */

namespace App\Lib;


class Result
{
    public $code;//返回码（-1: 系统异常 ;0:失败 ;1: 成功）
    public $message; //描述信息

    public function __construct($rs, $msg="")
    {
        $this->code = $rs ? 1 : 0;
        $this->message = $msg;
    }
}