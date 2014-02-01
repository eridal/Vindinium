<?php

namespace Vindinium;

class State {

    use Data;

    private static $FIELDS = array(
        'game' => 'Vindinium\\Game',
        'hero' => 'Vindinium\\Hero',
        'token' => 'string',
        'viewUrl' => 'string',
        'playUrl' => 'string',
    );

    /**
     * @var Game
     */
    public $game;

    /**
     * @var Board
     */
    public $board;

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

    /**
     * @internal
     */
    protected function init() {
        $this->board = $this->game->board;
    }
}
