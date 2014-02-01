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

    /**
     * @internal
     */
    protected function init() {
        $this->tiles = Board\TilesReader::readTiles($this->tiles, $this->size);
    }

    /**
     * @param Closure $predicate
     * @return array
     */
    function find(\Closure $predicate) {
        $matches = array();
        foreach ($this->tiles as $x => $line) {
            foreach ($line as $y => $tile) {
                if ($predicate($tile)) {
                    $matches[] = $tile;
                }
            }
        }
        return $matches;
    }

    /**
     * @return array of Tile
     */
    function Avatars() {
        return $this->find(function ($tile) {
            return $tile instanceof Map\Avatar;
        });
    }

    /**
     * @return array of Tile\GoldMin
     */
    function GoldMines() {
        return $this->find(function ($tile) {
            return $tile instanceof Map\GoldMine;
        });
    }

    /**
     *
     */
    function Taverns() {
        return $this->find(function ($tile) {
            return $tile instanceof Map\Tavern;
        });
    }
}
