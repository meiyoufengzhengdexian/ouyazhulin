<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 11:02
 */

namespace App\Lib;


use InvalidArgumentException;

class MyArrayParser extends MyParsers
{

    private $array;

    public function __construct($data) {
        if (is_string($data)) {
            $data = unserialize($data);
        }

        if (is_array($data) || is_object($data)) {
            $this->array = (array) $data;
        } else {
            throw new InvalidArgumentException(
                'ArrayParser only accepts (optionally serialized) [object, array] for $data.'
            );
        }
    }

    public function toArray() {
        return $this->array;
    }

    public function setRoot($root)
    {
        $this->root = $root;
    }
}