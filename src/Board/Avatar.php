<?php

namespace Vindinium\Board;

use Vindinium\Tile;
use Vindinium\Position;
use Vindinium\Hero;

class Avatar extends Tile {

    /**
     * @var int
     */
    public $heroId;

    /**
     * @param Position $pos
     * @param int $heroId
     */
    function __construct(Position $pos, $heroId) {
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
}
