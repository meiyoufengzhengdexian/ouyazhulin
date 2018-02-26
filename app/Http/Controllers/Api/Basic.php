<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class Basic extends Controller
{
    abstract function getResult();

}
