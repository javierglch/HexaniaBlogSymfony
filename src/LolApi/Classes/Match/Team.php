<?php

namespace LolApi\Classes\Match;

/**
 * Team
 * This object contains team information
 * @author Javier
 */
class Team {

    /**
     * 
     * @var BannedChampion array List[BannedChampion]    
     */
    public $bans;

    /**
     * Number of times the team killed baron
     * @var int
     */
    public $baronKills;

    /**
     * If game was a dominion game, specifies the points the team had at game end, otherwise null
     * @var long
     */
    public $dominionVictoryScore;

    /**
     * Number of times the team killed dragon
     * @var int
     */
    public $dragonKills;

    /**
     * Flag indicating whether or not the team got the first baron kill
     * @var boolean
     */
    public $firstBaron;

    /**
     * Flag indicating whether or not the team got first blood
     * @var boolean
     */
    public $firstBlood;

    /**
     * Flag indicating whether or not the team got the first dragon kill
     * @var boolean
     */
    public $firstDragon;

    /**
     * Flag indicating whether or not the team destroyed the first inhibitor
     * @var boolean
     */
    public $firstInhibitor;

    /**
     * Flag indicating whether or not the team got the first rift herald kill
     * @var boolean
     */
    public $firstRiftHerald;

    /**
     * Flag indicating whether or not the team destroyed the first tower
     * @var boolean
     */
    public $firstTower;

    /**
     * Number of times the team killed rift herald
     * @var int
     */
    public $inhibitorKills;

    /**
     * 
     * @var int
     */
    public $riftHeraldKills;

    /**
     * Team ID
     * @var int
     */
    public $teamId;

    /**
     * Number of towers the team destroyed
     * @var int
     */
    public $towerKills;

    /**
     * Number of times the team killed vilemaw
     * @var int
     */
    public $vilemawKills;

    /**
     * Flag indicating whether or not the team won
     * @var boolean
     */
    public $winner;

    function __construct($d) {
        $this->bans = [];
        foreach ($d->bans as $o) {
            $this->bans[] = new BannedChampion($o);
        }
        $this->baronKills = $d->baronKills;
        $this->dominionVictoryScore = $d->dominionVictoryScore;
        $this->dragonKills = $d->dragonKills;
        $this->firstBaron = $d->firstBaron;
        $this->firstBlood = $d->firstBlood;
        $this->firstDragon = $d->firstDragon;
        $this->firstInhibitor = $d->firstInhibitor;
        $this->firstRiftHerald = $d->firstRiftHerald;
        $this->firstTower = $d->firstTower;
        $this->inhibitorKills = $d->inhibitorKills;
        $this->riftHeraldKills = $d->riftHeraldKills;
        $this->teamId = $d->teamId;
        $this->towerKills = $d->towerKills;
        $this->vilemawKills = $d->vilemawKills;
        $this->winner = $d->winner;
    }

}
