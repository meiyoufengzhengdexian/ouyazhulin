<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Json extends Basic
{
    protected $data;
    public function getResult()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

}
