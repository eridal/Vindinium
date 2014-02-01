<?php

namespace Vindinium\Board;

use Vindinium\Tile;
use Vindinium\Hero;

class Tavern extends Tile {

    /**
     * @param Hero $hero
     * @return boolean
     */
    function belongsTo(Hero $hero) {
        return false;
    }
}
