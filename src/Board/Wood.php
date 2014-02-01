<?php

namespace Vindinium\Board;

use Vindinium\Tile;
use Vindinium\Hero;

class Wood extends Tile {

    /**
     * @param Hero $hero
     * @return boolean
     */
    function belongsTo(Hero $hero) {
        return false;
    }
}
