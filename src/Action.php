<?php

namespace Vindinium;

class Action {

    const STAY  = 'Stay';
    const NORTH = 'North';
    const EAST  = 'East';
    const SOUTH = 'South';
    const WEST  = 'West';

    /**
     * @var array
     */
    static $DIRECTIONS = array(
        ACTION::NORTH,
        ACTION::EAST,
        ACTION::SOUTH,
        ACTION::WEST
    );

    /**
     * @var string
     */
    public $dir = ACTION::STAY;

    /**
     * @param string $to
     * @return mixed
     */
    function move($to) {
        if (in_array($to, self::$DIRECTIONS)) {
            $this->dir = $to;
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * @return string
     */
    function getDirection() {
        return $this->dir ? $this->dir : Action::STAY;
    }
}

