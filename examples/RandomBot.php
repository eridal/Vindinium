<?php

use Vindinium\Robot;
use Vindinium\State;
use Vindinium\Move;

class RandomBot implements Robot {

    function secretKey() {
        return 'mbomfzpl';
    }

    function play(State $state, Move $to) {
        $to->random();
    }
}
