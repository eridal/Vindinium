<?php

namespace Vindinium;

class Server {

    /**
     * @var integer amount of time, in seconds, to wait for a new connection
     */
    static $MAX_CONNECT_SECONDS = 5;

    /**
     * @var string
     */
    public $secretKey;

    /**
     * @param string $host
     * @param string $secretKey
     */
    function __construct($secretKey) {
        $this->secretKey = trim($secretKey);
    }

    /**
     * @param string $url
     * @param array $params [optional]
     * @return array
     */
    function send($url, array $params = null) {

        $paramKey = array('key' => $this->secretKey);

        if (false === $ch = curl_init($url)) {
            throw new \RuntimeException;
        }

        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$MAX_CONNECT_SECONDS);
#       curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params ? $params + $paramKey : $paramKey));

        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($status < 200 or 300 <= $status) {
            throw new ServerException($result);
        }

        return json_decode($result, $asArray = true);
    }
}
