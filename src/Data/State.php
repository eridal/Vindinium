<?php

namespace Vindinium\Data;

use Vindinium\Server\Data;

class State {

    use Data;

    private static $FIELDS = array(
        'game' => 'Vindinium\\Data\\Game',
        'hero' => 'Vindinium\\Data\\Hero',
        'token' => 'string',
        'viewUrl' => 'string',
        'playUrl' => 'string',
    );

    /**
     * @var Game
     */
    public $game;

    /**
     * @var Hero
     */
    public $hero;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $viewUrl;

    /**
     * @var string
     */
    public $playUrl;
}
