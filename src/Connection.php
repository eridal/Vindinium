<?php

namespace Vindinium;

class Connection {

    /**
     * @var integer amount of time, in seconds, to wait for a new connection
     */
    static $MAX_CONNECT_SECONDS = 5;

    /**
     * @var string
     */
    public $key;

    /**
     * @param string $host
     * @param string $key
     */
    function __construct($key) {
        $this->key = trim($key);
    }

    /**
     * @param string $url
     * @param array $params [optional]
     * @return array
     */
    function send($url, array $params = null) {

        $key = array('key' => $this->key);

        if (false === $ch = curl_init($url)) {
            throw new \RuntimeException();
        }

        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, Connection::$MAX_CONNECT_SECONDS);
#       curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params ? $params + $key : $key));

        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($status < 200 or 300 <= $status) {
            throw new ServerException($result);
        }

        return json_decode($result, $asArray = true);
    }
}
