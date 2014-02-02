<?php

namespace Vindinium\Game;

use Vindinium\Client;

/**
 *
 * @link http://vindinium.org/starters#game-modes
 */
abstract class Mode {

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $params;

    /**
     * @param string $path
     * @param array $params
     */
    protected function __construct($path, $params = null) {
        $this->path = $path;
        $this->params = $params;
    }

    /**
     * @param Client $client
     * @return State
     */
    function create(Client $client) {
        $url = $client->hostUrl . $this->path;
        return $client->send($url, $this->params);
    }
}
