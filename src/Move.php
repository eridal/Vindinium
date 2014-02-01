<?php

namespace Vindinium;

class Move {

    const STAY  = 'Stay';
    const NORTH = 'North';
    const EAST  = 'East';
    const SOUTH = 'South';
    const WEST  = 'West';

    /**
     * @var array
     */
    static $DIRECTIONS = array(
        Move::NORTH,
        Move::EAST,
        Move::SOUTH,
        Move::WEST
    );

    /**
     * @var string
     */
    public $dir;

    /**
     * @param string $dir
     */
    function __construct($dir = null) {
        Check::argument(null === $dir or in_array($dir, Move::$DIRECTIONS));
        $this->dir = $dir ? $dir : Move::STAY;
    }

    /**
     * @return Move
     */
    static function random() {
        $dirs = array() + Move::$DIRECTIONS;
        shuffle($dirs);
        return new Move(
            $dirs[array_rand($dirs)]
        );
    }
}
