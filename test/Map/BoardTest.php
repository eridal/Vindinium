<?php

namespace Vindinium;

class BoardTest extends \PHPUnit_Framework_TestCase {

    private $board;


    function setUp() {
        $this->board = new Board(array(
         'size' => 4,
         'tiles' => '$-    $1' .
                    '  ##[]  ' .
                    '  []##  ' .
                    '@1    ##',
        ));
    }

    function testConstructor() {

        $this->assertObjectHasAttribute('size', $this->board);
        $this->assertEquals(4, $this->board->size);

        $this->assertObjectHasAttribute('tiles', $this->board);
        $this->assertCount(4, $this->board->tiles);

        foreach ($this->board->tiles as $line) {
            $this->assertCount(4, $line);
        }
    }

    function testTaverns() {
        $this->go($this->board->Taverns(), 'Vindinium\\Board\\Tavern', 2);
    }

    function testAvatars() {
        $this->go($this->board->Avatars(), 'Vindinium\\Board\\Avatar', 1);
    }

    function testGoldMines() {
        $this->go($this->board->GoldMines(), 'Vindinium\\Board\\GoldMine', 2);
    }

    function go($result, $class, $count) {
        $this->assertInternalType('array', $result);
        $this->assertCount($count, $result);

        foreach ($result as $tile) {
            $this->assertInstanceOf('Vindinium\\Tile', $tile);
            $this->assertTrue(class_exists($class));
            $this->assertInstanceOf($class, $tile);
        }

    }
}
