<?php

namespace Vindinium\Client;

use Vindinium\Client;
use Vindinium\Move;
use Vindinium\Robot;
use Vindinium\Server;

use Vindinium\Game\Mode;

/**
 *
 */
class Match {

    /**
     * @var Client
     */
    public $client;

    /**
     * @var Robot
     */
    public $robot;

    /**
     * @var State
     */
    public $state;

    /**
     * @param Client $client
     * @param Mode $mode
     * @param string $serverUrl
     */
    function __construct(Robot $robot, Mode $gameMode = null, $serverUrl = null) {

        $this->robot = $robot;
        $this->client = new Client(
            new Server($robot->secretKey())
        );

        $this->state = $this->client->createGame($gameMode, $serverUrl);
    }

    /**
     * @return string
     */
    function __toString() {
        if ($this->state) {
            return (string) $this->state->viewUrl;
        }
    }

    /**
     * @return boolean
     */
    function finished() {
        return $this->state->game->finished or
               $this->state->hero->crashed;
    }

    /**
     * @return boolean `true` if hero has crashed
     */
    function play() {

        $move = $this->robot->play($this->state);

        if ($move instanceof Move) {
            $params = $move->params();
        } else {
            $params = null;
        }

        $this->state = $this->client->send($this->state->playUrl, $params);
    }

}
