<?php

namespace Vindinium;

use Prelude\Arrays;

/**
 * @link http://vindinium.org/starters#json-hero
 */
class Hero {

    use Data;

    private static $FIELDS = array(
        'id' => 'int',
        'name' => 'string',
//        'userId' => 'string', // <-- optional
//        'elo' => 'int',
        'pos' => 'Vindinium\\Position',
        'life' => 'int',
        'gold' => 'int',
        'mineCount' => 'int',
        'spawnPos' => 'Vindinium\\Position',
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
    public $pos;

    /**
     * @var Position
     */
    public $spawnPos;

    /**
     * @internal
     */
    function init(array $data) {
        $this->userId = Arrays::get($data, 'userId');
        $this->elo = (int) Arrays::get($data, 'elo');
    }
}
