<?php

namespace Vindinium\Game;

/**
 * In training mode, you can play against some dummy bots.
 *
 * You can specify the number of `$turns` you want to play and, if you want,
 * you can provide a specific `$map` to test your algorithms.
 *
 * The games played in Training mode are not scored, so feel free to use it as much as you want.
 */
class Training extends Mode {

    /**
     * @var string
     */
    static $PATH = '/api/training';

    /**
     * @param int $turns [optional] The number of turns you want to play.
     *                   If you don't specify this parameter, 300 turns will be played.
     *
     * @param string $map [optional] The map id corresponding to the map you want to use.
     *                    Possible values are: m1, m2, m3, m4, m5, m6.
     *                    If you don't specify this parameter, a random map will be generated for you.
     *
     * @link https://github.com/ornicar/vindinium/blob/master/app/Maps.scala
     */
    function __construct($turns = null, $map = null) {

        $params = null;

        $turns and (
            $params['turns'] = $turns
        );

        $map and (
            $params['map'] = $map
        );

        parent::__construct(self::$PATH, $params);
    }
}
