<?php

namespace Vindinium\Board;

use Vindinium\Position;

use Prelude\Arrays;

abstract class TilesReader {

    /**
     * Tile size, in characters
     */
    const TILE_LEN = 2; # characters

    /**
     * @param string $tiles
     * @param int $size
     * @return array
     */
    static function readTiles($tiles, $size) {

        $board = array();

        for ($x = 0; $x < $size; $x++) {

            $board[$x] = array();

            for ($y = 0; $y < $size; $y++) {

                $from = ($x * $size + $y) * self::TILE_LEN;

                $tile = substr($tiles, $from, self::TILE_LEN);
                $pos = Position::create($x, $y);

                $board[$x][] = self::readTile($pos, $tile);
            }
        }

        return $board;
    }

    /**
     * Reference:
     *     ## Impassable wood
     *     @1 Hero number 1
     *     [] Tavern
     *     $- Gold mine (neutral)
     *     $1 Gold mine (belonging to hero 1)
     *
     * @param string $chars
     * @return Tile
     */
    private static function readTile(Position $pos, $chars) {

        static $TILE_CLASSES = array(
            '  ' => 'Vindinium\\Board\\EmptyTile',
            '##' => 'Vindinium\\Board\\Wood',
            '[]' => 'Vindinium\\Board\\Tavern',
            '$-' => 'Vindinium\\Board\\GoldMine',
        );

        if ($Tile = Arrays::get($TILE_CLASSES, $chars)) {
            return new $Tile($pos);
        }

        $heroId = (int) substr($chars, 1);

        if ('@' === $chars[0]) {
            return new Avatar($pos, $heroId);
        }

        if ('$' === $chars[0]) {
            return new GoldMine($pos, $heroId);
        }

        throw new \InvalidArgumentException("Invalid tile: '$chars'");
    }
}
