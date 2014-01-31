<?php

namespace Vindinium\Server;

use Prelude\Arrays;
use Prelude\Check;

trait Data {

    /**
     * @param array $data
     */
    final function __construct(array $data) {
        $this->read($data, static::$FIELDS);
        $this->init($data);
    }

    /**
     * @param array $data
     * @return void
     */
    function init(array $data) {
        // template method
    }

    /**
     * @param array $data
     * @param array $fields
     * @param object $object
     */
    private function read(array $data, array $fields) {
        foreach ($fields as $field => $type) {
            if (true === $type) {
                var_dump($field); exit;
            }
            $value = Arrays::getOrThrow($data, $field, new \Exception("missing required '$field'"));
            $this->{$field} = $this->valueToType($value, $type);
        }
    }

    /**
     * @param object $value [description]
     * @param string|array $type one of 'bool', 'int', 'float', string', 'Namespace\\Class'
     * @return object
     */
    private function valueToType($value, $type) {
        if (is_array($type)) {

            Check::argument(is_array($value));

            $result = array();
            foreach ($value as $v) {
                $result[] = $this->valueToType($v, $type[0]);
            }

            return $result;
        }

        static $TYPES = array('bool', 'int', 'float', 'string');

        if (in_array($type, $TYPES)) {
            settype($value, $type);
        } elseif (class_exists($type)) {
            $value = new $type($value);
        } else {
            throw new \InvalidArgumentException("unknown type: $type");
        }

        return $value;
    }
}
