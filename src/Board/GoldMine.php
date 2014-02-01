<?php

namespace Vindinium\Board;

use Vindinium\Tile;
use Vindinium\Position;
use Vindinium\Hero;

class GoldMine extends Tile {

    /**
     * @var int
     */
    public $heroId;

    /**
     * @param Position $pos
     * @param int $heroId
     */
    function __construct(Position $pos, $heroId = null) {
        parent::__construct($pos);
        $this->heroId = $heroId;
    }

    /**
     * @param Hero $hero
     * @return boolean
     */
    function belongsTo(Hero $hero) {
        return $this->heroId === $hero->id;
    }

    /**
     * @return boolean
     */
    function isNeutral() {
        return null === $this->heroId;
    }
}
