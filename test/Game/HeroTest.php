<?php

namespace Vindinium\Game;

class HeroTest extends \PHPUnit_Framework_TestCase {

    private $data =  array(
        'id' => 1,
        'name' => 'vjousse',
        'userId' => 'j07ws669',
        'elo' => 1200,
        'pos' => array(
           'x' => 5,
           'y' => 6
        ),
        'life' => 60,
        'gold' => 0,
        'mineCount' => 0,
        'spawnPos' => array(
           'x' => 5,
           'y' => 6
        ),
        'crashed' => true
    );

    function testHeroConstructor() {

        $hero = new Hero($this->data);

        foreach ($this->data as $field => $value) {

            $this->assertObjectHasAttribute($field, $hero);

            if (is_scalar($value)) {
                $this->assertEquals($value, $hero->{$field});
                continue;
            }

            $this->assertInternalType('array', $value);

            foreach ($value as $k => $v) {
                $this->assertObjectHasAttribute($k, $hero->{$field});
                $this->assertEquals($v, $hero->{$field}->{$k});
            }
        }
    }
}
