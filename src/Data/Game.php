<?php

namespace Vindinium\Data;

use Vindinium\Server\Data;

/**
 * @link http://vindinium.org/starters#json-doc
 */
class Game {

    use Data;

    private static $FIELDS = array(
        'id' => 'string',
        'turn' => 'int',
        'maxTurns' => 'int',
        'heroes' => array('Vindinium\\Data\\Hero'),
        'board' => 'Vindinium\\Data\\Board',
        'finished' => 'bool'
    );

    /**
     * Unique identifier of the game
     *
     * @var string
     */
    public $id;

    /**
     * Current number of turns since the beginning.
     * Each turn contains 4 move (one for each player)
     *
     * @var int
     */
    public $turn;

    /**
     * Maximum number of turns
     *
     * @var int
     */
    public $maxTurns;

    /**
     * @var array of {@link Hero}
     */
    public $heroes;

    /**
     * @var bool
     */
    public $finished;

    /**
     *
     */
    function init() {
        $this->turn = (int)($this->turn / 4);
        $this->maxTurns = (int)($this->maxTurns / 4);
    }
    /**
     * @return boolean
     */
    function hasTurns() {
        return $this->maxTurns > $this->turn;
    }
}
