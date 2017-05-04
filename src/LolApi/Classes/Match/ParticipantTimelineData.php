<?php

namespace LolApi\Classes\Match;

/**
 * ParticipantTimelineData
 * This object contains timeline data
 * @author Javier
 */
class ParticipantTimelineData {

    /**
     * Value per minute from the beginning of the game to 10 min
     * @var double 
     */
    public $zeroToTen;

    /**
     * Value per minute from 10 min to 20 min
     * @var double 
     */
    public $tenToTwenty;

    /**
     * Value per minute from 30 min to the end of the game
     * @var double 
     */
    public $thirtyToEnd;

    /**
     * Value per minute from 20 min to 30 min
     * @var double 
     */
    public $twentyToThirty;

    function __construct($d) {
        $this->zeroToTen = $d->zeroToTen;
        $this->tenToTwenty = $d->tenToTwenty;
        $this->thirtyToEnd = $d->thirtyToEnd;
        $this->twentyToThirty = $d->twentyToThirty;
    }

}
