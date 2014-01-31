<?php

namespace Vindinium;

interface Robot {

    /**
     * Keep it secret. You will need it as an API parameter to authenticate your AI with the server.
     *
     * If you forget your key, you're screwed. There is no recovery.
     *
     * @return string the api secret
     *
     * @link http://vindinium.org/register
     */
    function key();

    /**
     * @param State $state
     * @param Action $action
     *
     * @return Action
     */
    function play(State $state, Action $action);
}
