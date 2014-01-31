<?php

namespace Vindinium\Server;

class Response {

    /**
     * @var int
     */
    public $status;

    /**
     * @var string
     */
    public $body;

    /**
     * @param int $status
     * @param string $body
     */
    function __construct($status, $body) {
        file_put_contents('b', $body);
        $this->status = $status;
        $this->body = $body;
    }

    /**
     * @return boolean
     */
    function isError() {
        return $this->status < 200 or 300 <= $this->status;
    }

    /**
     * @return array
     */
    function getJson() {
        return json_decode($this->body, $asArray = true);
    }
}
