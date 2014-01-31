<?php

namespace Vindinium;

class Runner {

    /**
     * @var Robot
     */
    public $robot;

    /**
     * @var State
     */
    public $state;

    function __construct(Robot $robot, State $state) {
        $this->robot = $state;
        $this->state = $state;
    }
}
