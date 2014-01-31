<?php

namespace Vindinium\Data;

use Prelude\Arrays;

/**
 *
 */
class Position {

    /**
     * @var int
     */
    public $x;

    /**
     * @var int
     */
    public $y;

    /**
     * @param array $data [description]
     */
    function __construct(array $data) {
        $this->x = Arrays::getOrThrow($data, 'x');
        $this->y = Arrays::getOrThrow($data, 'y');
    }

    /**
     * Returns the distance
     *
     * @param Position $pos
     * @return int
     *
     * @link http://xlinux.nist.gov/dads/HTML/manhattanDistance.html
     */
    function distanceTo(Position $pos) {
         return abs($this->x - $pos->x) + abs($this->y - $pos->y);
    }
}
