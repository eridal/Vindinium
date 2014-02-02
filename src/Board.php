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

    use ServerData;

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
        $accepted = array();
        foreach ($this->tiles as $x => $line) {
            foreach ($line as $y => $tile) {
                if ($predicate($tile)) {
                    $accepted[] = $tile;
                }
            }
        }
        return $accepted;
    }

    /**
     * @param Closure $predicate [optional]
     * @return array of Tile\GoldMine
     */
    function Avatars(\Closure $predicate=null) {
        return $this->find(function ($t) use ($predicate) {
            if ($t instanceof Board\Avatar) {
                return $predicate ? $predicate($t) : true;
            }
            return false;
        });
    }

    /**
     * @param Closure $predicate [optional]
     * @return array of Tile\GoldMine
     */
    function Mines(\Closure $predicate=null) {
        return $this->find(function ($t) use ($predicate) {
            if ($t instanceof Board\GoldMine) {
                return $predicate ? $predicate($t) : true;
            }
            return false;
        });
    }

    /**
     * @param Closure $predicate [optional]
     * @return array of Tile\Tavern
     */
    function Taverns(\Closure $predicate=null) {
        return $this->find(function ($t) use ($predicate) {
            if ($t instanceof Board\Tavern) {
                return $predicate ? $predicate($t) : true;
            }
            return false;
        });
    }
}
