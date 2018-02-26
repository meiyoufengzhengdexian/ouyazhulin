<?php

namespace App\Http\Controllers\Api;
use App\Exceptions\XmlCantParseException;
use App\Lib\MyFormatter;
use Illuminate\Http\Request;

class Xml extends Basic
{
    protected $data;

    function getResult($root = 'xml')
    {

        if(is_array($this->data)){
            $formatter = MyFormatter::make($this->data, MyFormatter::ARR, $root);
            if(method_exists($formatter, 'toMyXml')){
                $res = $formatter->toMyXml($root);
            }else{
                $res = $formatter->toXml();
            }
            return response($res, 200, [
                'Content-type'=>'text/xml'
            ]);
        }else{
            return '';
        }
    }

    public static function Xml2Obj($xmlString)
    {
        try{
            return new \SimpleXMLIterator($xmlString);
        } catch (\Exception $e){
            throw new XmlCantParseException($e->getMessage(). ',xml: >>>'.$xmlString. '<<<');
        }
    }

    public static function getInput()
    {
        $xml = file_get_contents('php://input');

        $obj = self::Xml2Obj($xml);
        return $obj;
    }

}
