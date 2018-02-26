<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 10:36
 */

namespace App\Lib\Tn;


class Result
{
    public $Code;
    public $Message;

    public function __construct($Code, $Message= 'Success')
    {
        $this->Code = !!$Code;
        $this->Message = $Message;
    }
}