<?php

namespace Vindinium;

use Prelude\Check;

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
    private $dir = Move::STAY;

    /**
     * @param string $dir
     */
    function __toString() {
        return (string) $this->dir;
    }

    /**
     * @return string
     */
    function random() {
        $dirs = array() + Move::$DIRECTIONS;
        shuffle($dirs);
        return $this->dir = $dirs[array_rand($dirs)];
    }

    /**
     * @return Move
     */
    function stay() {
        $this->dir = Move::STAY;
        return $this;
    }

    /**
     * @return Move
     */
    function north() {
        $this->dir = Move::NORTH;
        return $this;
    }

    /**
     * @return Move
     */
    function east() {
        $this->dir = Move::EAST;
        return $this;
    }

    /**
     * @return Move
     */
    function south() {
        $this->dir = Move::SOUTH;
        return $this;
    }

    /**
     * @return Move
     */
    function west() {
        $this->dir = Move::WEST;
        return $this;
    }
}
