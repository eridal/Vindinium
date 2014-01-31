<?php

namespace Vindinium;

class Client {

    /**
     * Default server
     */
    static $DEFAULT_HOST = 'vindinium.org';

    /**
     * @var string
     */
    public $server;

    /**
     * @param string $server
     */
    function __construct($key) {
        $this->server = new Connection($key);
    }

    /**
     * @return Runner
     */
    function createGame($mode = 'training', $host = null) {
/*
        if ($mode == 'training') {
            // Don't pass the 'map' parameter if you want a random map
            $params = array(
                'key' => $this->key,
                'turns' => $this->numberOfTurns,
                'map' => 'm1'
            );
        }
*/
        $host = $host ? $host : self::$DEFAULT_HOST;
        return $this->send("http://$host/api/$mode");
    }

    /**
     * @param url $url    [description]
     * @param array|Action $params [description]
     * @return State
     */
    function send($url, Action $action = null) {

        if ($action instanceof Action) {
            $params = array('dir' => $action->getDirection());
        } else {
            $params = null;
        }

        if ($data = $this->server->send($url, $params)) {
            return new State($data);
        }

        throw new \RuntimeException($response->body);
    }

}

class Client_
{

    CONST TIMEOUT = 15;

    /**
     * @var string the secret key code
     */
    private $key;

    /**
     * @var string "arena" or "trainning"
     */
    private $mode;

    /**
     * @var int
     */
    private $numberOfGames;

    /**
     * @var int
     */
    private $numberOfTurns;



    /**
     * @param string $key
     * @param string $mode "arena" or "trainning"
     * @param int $numberOfTurns
     * @param string $serverUrl [optional]
     */
    function __construct($key, $mode, $numberOfTurns, $serverUrl = null) {

        $this->key = $key;
        $this->mode = $mode;

        if ($this->mode == "training") {
            $this->numberOfGames = 1;
            $this->numberOfTurns = $numberOfTurns;
        } else {
            $this->numberOfGames = $numberOfTurns;
            $this->numberOfTurns = 300; # Ignored in arena mode
        }

        $this->serverUrl = $serverUrl ? $serverUrl : Client::DEFAULT_URL;
    }

    /**
     * Send a move to the server
     *
     * @param string url
     * @param string $direction one of: 'Stay', 'North', 'South', 'East', 'West'
     * @return array
     */
    private function move($url, $direction)
    {

        try {
            $response = HttpPost::post($url, array('dir' => $direction), self::TIMEOUT);

            if ($response->isError()) {
                throw new \Exception("Error HTTP {$response->status}\n{$response->content}\n");
            }

            return json_decode($response->content, true);

        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            return array('game' => array('finished' => true));
        }
    }

    private function isFinished($state)
    {
        return $state['game']['finished'];
    }
}
