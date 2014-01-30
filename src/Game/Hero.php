<?php

namespace Vindinium\Game;

use Prelude\Arrays;

/**
 * @link http://vindinium.org/starters#json-hero
 */
class Hero {

    private static $FIELDS = array(
        'id' => 'int',
        'name' => 'string',
        'userId' => 'string',
        'elo' => 'int',
        'pos' => 'Vindinium\\Game\\Position',
        'life' => 'int',
        'gold' => 'int',
        'mineCount' => 'int',
        'spawnPos' => 'Vindinium\\Game\\Position',
        'crashed' => 'bool',
    );

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $userId;

    /**
     * @var int
     */
    public $eol;

    /**
     * @var @int
     */
    public $life;

    /**
     * @var Position
     */
    public $position;

    /**
     * @var Position
     */
    public $spawnPos;

    /**
     * @param array $data [description]
     */
    function __construct(array $data) {

        foreach (self::$FIELDS as $field => $type) {

            $value = Arrays::getOrThrow($data, $field);

            if (class_exists($type)) {
                $value = new $type($value);
            } else {
                settype($value, $type);
            }

            $this->{$field} = $value;
        }
    }
}
