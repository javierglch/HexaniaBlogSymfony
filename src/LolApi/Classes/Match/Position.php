<?php

namespace LolApi\Classes\Match;

/**
 * Position
 * This object contains participant frame position information
 * @author Javier
 */
class Position {

    /** @var int */
    public $x;

    /** @var int */
    public $y;

    function __construct($d) {
        $this->x = $d->x;
        $this->y = $d->y;
    }

}
