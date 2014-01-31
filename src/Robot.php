<?php

namespace Vindinium;

interface Robot {

    /**
     * @param State $state
     * @param Action $action
     *
     * @return Action
     */
    function play(State $state, Action $action);
}
