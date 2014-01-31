<?php

namespace Vindinium;


class BoardParser {

    /**
     * @param string $tiles
     * @param int $size
     * @return array
     */
    static function parse($tiles, $size) {

        $board = array();

        for ($x = 0; $x < $size; $x++) {

            $board[$x] = array();

            for ($y = 0; $y < $size; $y++) {
                $from = ($x * $size + $y ) * 2;

                $tile = substr($tiles, $from, 2);
                $board[$x][] = Tile::parse($x, $y, $tile);
            }
        }

        return $board;
    }
}
