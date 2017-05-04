<?php

namespace LolApi\Classes\Match;

/**
 * ParticipantFrame
 * This object contains participant frame information
 * @author Javier
 */
class ParticipantFrame {

    /**
     * Participant's current gold
     * @var int
     */
    public $currentGold;

    /**
     * Dominion score of the participant
     * @var int
     */
    public $dominionScore;

    /**
     * Number of jungle minions killed by participant
     * @var int
     */
    public $jungleMinionsKilled;

    /**
     * Participant's current level
     * @var int
     */
    public $level;

    /**
     * Number of minions killed by participant
     * @var int
     */
    public $minionsKilled;

    /**
     * Participant ID
     * @var int
     */
    public $participantId;

    /**
     * Participant's position
     * @var Position
     */
    public $position;

    /**
     * Team score of the participant
     * @var int
     */
    public $teamScore;

    /**
     * Participant's total gold
     * @var int
     */
    public $totalGold;

    /**
     * Experience earned by participant
     * @var int
     */
    public $xp;

    function __construct($d) {
        $this->currentGold = $d->currentGold;
        $this->dominionScore = $d->dominionScore;
        $this->jungleMinionsKilled = $d->jungleMinionsKilled;
        $this->level = $d->level;
        $this->minionsKilled = $d->minionsKilled;
        $this->participantId = $d->participantId;
        $this->position = new Position($d->position);
        $this->teamScore = $d->teamScore;
        $this->totalGold = $d->totalGold;
        $this->xp = $d->xp;
    }

    
    
    /**
     * Devuelve el objeto participantIdentity relacionado
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return ParticipantIdentity
     */
    public function getParticipantIdentity(MatchDetail $MatchDetail) {
        return $MatchDetail->participantIdentities[$this->participantId - 1];
    }
    
    /**
     * Devuelve el objeto del particianpante
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return Participant
     */
    public function getParticipant(MatchDetail $MatchDetail) {
        return $MatchDetail->participants[$this->participantId - 1];
    }
}
