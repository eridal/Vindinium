<?php

namespace Vindinium\Game;

/**
 * In arena mode, you will play against other players.
 *
 * Your games will be rated and your rank will be updated accordingly.
 */
final class Arena extends Mode {

    /**
     * @var string
     */
    static $PATH = '/api/arena';

    function __construct() {
        parent::__construct(self::$PATH);
    }
}
