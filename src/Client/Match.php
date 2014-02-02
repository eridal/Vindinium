<?php

namespace Vindinium\Client;

use Vindinium\Client;
use Vindinium\Move;
use Vindinium\Robot;
use Vindinium\Server;
use Vindinium\Game\Mode;

use Prelude\Arrays;
use Prelude\Check;

final class Match {

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

    function play() {
        $this->robot->play($this->state, $move = new Move);
        $this->state = $this->client->send(
            $this->state->playUrl,
            array('dir' => (string) $move)
        );
    }

    /**
     * @return Hero
     */
    function winner() {

        $players = Arrays::sortBy($this->state->game->heroes, function ($hero) {
            return $hero->gold;
        });

        return end($players);
    }

}
