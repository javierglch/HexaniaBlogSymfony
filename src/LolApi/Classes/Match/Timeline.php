<?php

namespace LolApi\Classes\Match;

/**
 * Timeline
 * This object contains game timeline information
 * @author Javier
 */
class Timeline {

    /**
     * Time between each returned frame in milliseconds.
     * @var long
     */
    public $frameInterval;
    
    /**
     * List of timeline frames for the game.
     * @var array List[Frame]
     */
    public $frames;
    
    function __construct($d) {
        $this->frameInterval = $d->frameInterval;
        $this->frames = [];
        foreach ($d->frames as $o) {
            $this->frames[]=new Frame($o);
        }
    }

}
