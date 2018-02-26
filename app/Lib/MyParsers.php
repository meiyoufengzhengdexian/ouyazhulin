<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 10:49
 */

namespace App\Lib;


use Illuminate\Support\Str;
use Illuminate\Support\Debug\Dumper;
use ReflectionClass;
use SoapBox\Formatter\Parsers\Parser;

abstract class MyParsers extends Parser
{
    protected $root = 'xml';

    private function xmlify($data, $structure = null, $basenode = null) {
        // turn off compatibility mode as simple xml throws a wobbly if you don't.
        if(!$basenode){
            $basenode = $this->root;
        }
        if (ini_get('zend.ze1_compatibility_mode') == 1) {
            ini_set('zend.ze1_compatibility_mode', 0);
        }

        if ($structure == null) {
            $structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
        }

        // Force it to be something useful
        if (!is_array($data) && !is_object($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            // convert our booleans to 0/1 integer values so they are
            // not converted to blanks.
            if (is_bool($value)) {
                $value = (int) $value;
            }

            // no numeric keys in our xml please!
            if (is_numeric($key)) {
                // make string key...
                if(Str::singular($basenode) != $basenode){
                    $key = Str::singular($basenode);
                }else if(is_object($value)){
                    $ref = new ReflectionClass($value);
                    $key = basename($ref->getName());
                }else{
                    $key = 'item';
                }
            }

            // replace anything not alpha numeric
            $key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

            // if there is another array found recrusively call this function
            if (is_array($value) or is_object($value)) {
                $node = $structure->addChild($key);

                // recursive call if value is not empty
                if (!empty($value)) {
                    $this->xmlify($value, $node, $key);
                }
            } else {
                // add single node.
                $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, "UTF-8");

                $structure->addChild($key, $value);
            }
        }

        // pass back as string. or simple xml object if you want!
        return $structure->asXML();
    }
    /*
     * overwrite
     */
    public function toXml() {
        return $this->xmlify($this->toArray());
    }

    public function toMyXml($root)
    {
        return $this->xmlify($this->toArray(), $root);
    }
}