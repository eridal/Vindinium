<?php

namespace Vindinium;

use Prelude\Arrays;

/**
 * @link http://vindinium.org/starters#json-hero
 */
class Hero {

    use ServerData;

    private static $FIELDS = array(
        'id' => 'int',
        'name' => 'string',
//      'userId' => 'string', // <-- optional
//      'elo' => 'int',       // <-- optional
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
    public $elo;

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
    protected function init(array $data) {
        $this->userId = Arrays::get($data, 'userId');
        $this->elo = (int) Arrays::get($data, 'elo');
    }

    /**
     * @return string
     */
    function __toString() {
        return (string) $this->name;
    }
}
