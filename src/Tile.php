<?php

namespace Vindinium;

use Prelude\Arrays;

abstract class Tile {

    /**
     * @var Position
     */
    public $pos;

    /**
     * @param int $x
     * @param int $y
     */
    function __construct($x, $y) {
        $this->pos = POsition::create($x, $y);
    }

    /**
     * @return boolean
     */
    function isWakeable() {
        return false;
    }

    /**
     * Reference:
     *     ## Impassable wood
     *     @1 Hero number 1
     *     [] Tavern
     *     $- Gold mine (neutral)
     *     $1 Gold mine (belonging to hero 1)
     *
     * @param string $info
     * @return Tile]
     */
    static function parse($x, $y, $info) {

        static $TILES = array(
            '  ' => 'Vindinium\\EmptyTile',
            '##' => 'Vindinium\\WoodTile',
            '[]' => 'Vindinium\\TavernTile',
            '$-' => 'Vindinium\\GoldTile',
        );

        if ($class = Arrays::get($TILES, $info)) {
            return new $class($x, $y);
        }

        $heroId = (int) substr($info, 1);

        if ('@' === $info[0]) {
            return new HeroTile($x, $y, $heroId);
        }

        if ('$' === $info[0]) {
            return new GoldTile($x, $y, $heroId);
        }

        throw new \InvalidArgumentException("Invalid tile: '$info'");
    }
}

trait HasHeroId {
    public $heroId;
    function __construct($x, $y, $heroId) {
        parent::__construct($x, $y);
        $this->heroId = $heroId;
    }
}

class EmptyTile extends Tile {
    /**
     * @return boolean
     */
    function isWakeable() {
        return true;
    }
}

class WoodTile extends Tile {

}

class TavernTile extends Tile {

}

class HeroTile extends Tile {

    public $heroId;

    function __construct($x, $y, $heroId) {
        parent::__construct($x, $y);
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

class GoldTile extends HeroTile {

    function __construct($x, $y, $heroId = null) {
        parent::__construct($x, $y, $heroId);
    }
}
