<?php

namespace Vindinium;

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

        $this->assertTrue($ZERO->equals($ZERO));
        $this->assertTrue($pos->equals($pos));

        $this->assertFalse($ZERO->equals($pos));
        $this->assertFalse($pos->equals($ZERO));

        $this->assertEquals(0, $pos->distanceTo($pos));
        $this->assertEquals($ZERO->distanceTo($pos), $pos->distanceTo($ZERO), "Zero.distanceTo($pos->x, $pos->y)");
    }

    function testCreate() {
        $x = 53;
        $y = 87;

        $pos = Position::create($x, $y);

        $this->assertEquals($x, $pos->x);
        $this->assertEquals($y, $pos->y);

        $this->assertEquals("($x, $y)", (string) $pos);
    }
}
