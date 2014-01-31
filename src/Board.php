<?php

namespace Vindinium;

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

    function init() {
        $this->tiles = BoardParser::parse($this->tiles, $this->size);
    }

    /**
     * @param Position $from
     * @param Position $to
     *
     * @return string
     */
    function findMove(Position $from, Position $to) {
        $x = $from->x - $to->x;
        $y = $from->y - $to->y;

        $moves = array();

        if ($x < 0) $moves[] = Action::EAST;
        if ($x > 0) $moves[] = Action::WEST;
        if ($y < 0) $moves[] = Action::NORTH;
        if ($y > 0) $moves[] = Action::SOUTH;


        if (count($moves)) {
            shuffle($moves);
            return $moves[0];
        }

        // you are just there
        return Action::STAY;
    }

    /**
     * @return Tiles
     */
    function getMines() {
        $mines = array();
        foreach ($this->tiles as $x => $line) {
            foreach ($line as $y => $tile) {
                if ($tile instanceof GoldTile) {
                    $mines[] = $tile;
                }
            }
        }
        return $mines;
    }
}
