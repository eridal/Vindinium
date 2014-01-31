<?php

namespace Vindinium\Data;

use Vindinium\Server\Data;

/**
 * As the map is always a square, this number is the same for X and Y.
 * Tiles is a string representing the map.
 *
 * Each tile is coded using two chars.
 * As you may already have noticed, to get each line of the map,
 * you just have to use a %size (modulo) on the tiles.
 *
 */
class Board {

    use Data;

    private static $FIELDS = array(
        'size' => 'int',
        'tiles' => 'string'
    );

    /**
     * @var int
     */
    public $size;

    /**
     * @var string
     */
    public $tiles;
}
