<?php

namespace Vindinium;

abstract class Tile {

    /**
     * @var Position
     */
    public $pos;

    /**
     * @param Position $pos
     */
    function __construct(Position $pos) {
        $this->pos = $pos;
    }

    /**
     * Returns `true` if this Tile belongs to `$hero`
     *
     * @param Hero $hero
     * @return boolean
     */
    abstract function belongsTo(Hero $hero);
}
