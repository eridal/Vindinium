<?php

use Vindinium\Robot;
use Vindinium\State;
use Vindinium\Action;

class RandomBot implements Robot {

    function play(State $state, Action $action) {
        $dirs = Action::$DIRECTIONS;
        $action->move(
            $dirs[array_rand($dirs)]
        );
    }
}