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
    function secretKey();

    /**
     * @param State $state
     * @param Move $to
     *
     * @return void
     */
    function play(State $state, Move $to);
}
