<?php

namespace Vindinium;

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
     * @return string
     */
    function __toString() {
        return "({$this->x}, {$this->y})";
    }

    /**
     * Distance to an another position
     *
     * @param Position $pos
     * @return int
     *
     * @link http://xlinux.nist.gov/dads/HTML/manhattanDistance.html
     */
    function distanceTo(Position $pos) {
         return abs($this->x - $pos->x) + abs($this->y - $pos->y);
    }

    /**
     * @param Position $pos
     * @return boolean
     */
    function equals(Position $pos) {
        return 0 === $this->distanceTo($pos);
    }

    /**
     * @param int $x
     * @param int $y
     * @return Position
     */
    static function create($x, $y) {
        return new Position(array(
            'x' => $x,
            'y' => $y,
        ));
    }
}
