<?php

namespace Vindinium;

class Client {

    /**
     * Default host
     */
    static $DEFAULT_HOST_URL = 'http://vindinium.org';

    /**
     * @var Server
     */
    public $server;

    /**
     * @var [type]
     */
    public $hostUrl;

    /**
     * @param Server $server
     */
    function __construct(Server $server, $hostUrl = null) {
        $this->server = $server;
        $this->hostUrl = $hostUrl ? $hostUrl : self::$DEFAULT_HOST_URL;
    }

    /**
     * @param Game\Mode $mode [optional]
     * @return Game\Runner
     */
    function createGame(Game\Mode $mode = null) {

        if (null === $mode) {
            $mode = new Game\Training();
        }

        return $mode->create($this);
    }

    /**
     * @param string $url
     * @param array $params [optional]
     * @return State
     */
    function send($url, array $params = null) {

        if ($data = $this->server->send($url, $params)) {
            return new State($data);
        }

        throw new ServerException("Bad Response from Server");
    }
}
