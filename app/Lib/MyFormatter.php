<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 10:55
 */

namespace App\Lib;


use InvalidArgumentException;
use SoapBox\Formatter\Formatter;
use SoapBox\Formatter\Parsers\ArrayParser;
use SoapBox\Formatter\Parsers\CsvParser;
use SoapBox\Formatter\Parsers\JsonParser;
use SoapBox\Formatter\Parsers\XmlParser;
use SoapBox\Formatter\Parsers\YamlParser;

class MyFormatter
{
    /**
     * Add class constants that help define input format
     */
    const CSV  = 'csv';
    const JSON = 'json';
    const XML  = 'xml';
    const ARR  = 'array';
    const YAML = 'yaml';

    private static $supportedTypes = [self::CSV, self::JSON, self::XML, self::ARR, self::YAML];
    private $parser;

    /**
     * Make: Returns an instance of formatter initialized with data and type
     *
     * @param mixed $data The data that formatter should parse
     * @param string $type The type of data formatter is expected to parse
     * @param string $root
     * @return MyFormatter
     */
    public static function make($data, $type, $root='xml') {
        if (in_array($type, self::$supportedTypes)) {
            $parser = null;
            switch ($type) {
                case self::CSV:
                    $parser = new CsvParser($data);
                    break;
                case self::JSON:
                    $parser = new JsonParser($data);
                    break;
                case self::XML:
                    $parser = new MyXmlparser($data);

                    break;
                case self::ARR:
                    $parser = new MyArrayParser($data);
                    $parser->setRoot($root);
                    break;
                case self::YAML:
                    $parser = new YamlParser($data);
                    break;
            }
            return new self($parser, $type);
        }
        throw new InvalidArgumentException(
            'make function only accepts [csv, json, xml, array] for $type but ' . $type . ' was provided.'
        );
    }

    private function __construct($parser) {
        $this->parser = $parser;
    }

    public function toJson() {
        return $this->parser->toJson();
    }

    public function toArray() {
        return $this->parser->toArray();
    }

    public function toYaml() {
        return $this->parser->toYaml();
    }

    public function toXml() {
        return $this->parser->toXml();
    }

    public function toCsv() {
        return $this->parser->toCsv();
    }

}