<?php

namespace Vindinium\Board;

use Vindinium\Tile;
use Vindinium\Hero;

/**
 * A tile wich is, err... empty
 */
class EmptyTile extends Tile {

    /**
     * @param Hero $hero
     * @return boolean
     */
    function belongsTo(Hero $hero) {
        return false;
    }
}
