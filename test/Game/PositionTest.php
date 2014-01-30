<?php

namespace Vindinium\Game;

class PositionTest extends \PHPUnit_Framework_TestCase {

    function testDistanceTo() {

        $ZERO = new Position(array(
            'x' => 0,
            'y' => 0
        ));

        $pos = new Position(array(
            'x' => rand(100, 200),
            'y' => rand(100, 200),
        ));

        $this->assertEquals(0, $pos->distanceTo($pos));
        $this->assertEquals($ZERO->distanceTo($pos), $pos->distanceTo($ZERO), "Zero.distanceTo($pos->x, $pos->y)");

    }
}
