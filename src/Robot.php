<?php

namespace Vindinium;

use Vindinium\State;
use Vindinium\Move;

interface Robot {

    /**
     * @param string $state
     * @return string
     */
    function play(State $state, Action $action) {
        return $action->south();
    }
}
