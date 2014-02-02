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

        if (false === $curl = curl_init($url)) {
            throw new ServerException('unable to initialize curl');
        }

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, self::$MAX_CONNECT_SECONDS);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params ? $params + $paramKey : $paramKey));

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $isError = $status < 200 or 300 <= $status;

        if ($isError) {
            $result = curl_error($curl);
        }

        curl_close($curl);

        if ($isError) {
            throw new ServerException($result, $status);
        }

        return json_decode($result, $asArray = true);
    }
}
