<?php

namespace LolApi\Classes\Stats;

/**
 * AggregatedStatsDto
 * This object contains aggregated stat information.
 * @author Javier
 */
class AggregatedStatsDto {

    /**
     * Dominion only.
     * @var int
     */
    public $averageAssists;

    /**
     * Dominion only.
     * @var int
     */
    public $averageChampionsKilled;

    /**
     * Dominion only.
     * @var int
     */
    public $averageCombatPlayerScore;

    /**
     * Dominion only.
     * @var int
     */
    public $averageNodeCapture;

    /**
     * Dominion only.
     * @var int
     */
    public $averageNodeCaptureAssist;

    /**
     * Dominion only.
     * @var int
     */
    public $averageNodeNeutralize;

    /**
     * Dominion only.
     * @var int
     */
    public $averageNodeNeutralizeAssist;

    /**
     * Dominion only.
     * @var int
     */
    public $averageNumDeaths;

    /**
     * Dominion only.
     * @var int
     */
    public $averageObjectivePlayerScore;

    /**
     * Dominion only.
     * @var int
     */
    public $averageTeamObjective;

    /**
     * Dominion only.
     * @var int
     */
    public $averageTotalPlayerScore;

    /**
     * 
     * @var int
     */
    public $botGamesPlayed;

    /**
     * 
     * @var int
     */
    public $killingSpree;

    /**
     * Dominion only.
     * @var int
     */
    public $maxAssists;

    /**
     * 
     * @var int
     */
    public $maxChampionsKilled;

    /**
     * Dominion only.
     * @var int
     */
    public $maxCombatPlayerScore;

    /**
     * 
     * @var int
     */
    public $maxLargestCriticalStrike;

    /**
     * 
     * @var int
     */
    public $maxLargestKillingSpree;

    /**
     * Dominion only.
     * @var int
     */
    public $maxNodeCapture;

    /**
     * Dominion only.
     * @var int
     */
    public $maxNodeCaptureAssist;

    /**
     * Dominion only.
     * @var int
     */
    public $maxNodeNeutralize;

    /**
     * Dominion only.
     * @var int
     */
    public $maxNodeNeutralizeAssist;

    /**
     * 	Only returned for ranked statistics.
     * @var int
     */
    public $maxNumDeaths;

    /**
     * Dominion only.
     * @var int
     */
    public $maxObjectivePlayerScore;

    /**
     * Dominion only.
     * @var int
     */
    public $maxTeamObjective;

    /**
     * 
     * @var int
     */
    public $maxTimePlayed;

    /**
     * 
     * @var int
     */
    public $maxTimeSpentLiving;

    /**
     * Dominion only.
     * @var int
     */
    public $maxTotalPlayerScore;

    /**
     * 
     * @var int
     */
    public $mostChampionKillsPerSession;

    /**
     * 
     * @var int
     */
    public $mostSpellsCast;

    /**
     * 
     * @var int
     */
    public $normalGamesPlayed;

    /**
     * 
     * @var int
     */
    public $rankedPremadeGamesPlayed;

    /**
     * 
     * @var int
     */
    public $rankedSoloGamesPlayed;

    /**
     * 
     * @var int
     */
    public $totalAssists;

    /**
     * 
     * @var int
     */
    public $totalChampionKills;

    /**
     * 
     * @var int
     */
    public $totalDamageDealt;

    /**
     * 
     * @var int
     */
    public $totalDamageTaken;

    /**
     * Only returned for ranked statistics.
     * @var int
     */
    public $totalDeathsPerSession;

    /**
     * 
     * @var int
     */
    public $totalDoubleKills;

    /**
     * 
     * @var int
     */
    public $totalFirstBlood;

    /**
     * 
     * @var int
     */
    public $totalGoldEarned;

    /**
     * 
     * @var int
     */
    public $totalHeal;

    /**
     * 
     * @var int
     */
    public $totalMagicDamageDealt;

    /**
     * 
     * @var int
     */
    public $totalMinionKills;

    /**
     * 
     * @var int
     */
    public $totalNeutralMinionsKilled;

    /**
     * Dominion only.
     * @var int
     */
    public $totalNodeCapture;

    /**
     * Dominion only.
     * @var int
     */
    public $totalNodeNeutralize;

    /**
     * 
     * @var int
     */
    public $totalPentaKills;

    /**
     * 
     * @var int
     */
    public $totalPhysicalDamageDealt;

    /**
     * 
     * @var int
     */
    public $totalQuadraKills;

    /**
     * 
     * @var int
     */
    public $totalSessionsLost;

    /**
     * 
     * @var int
     */
    public $totalSessionsPlayed;

    /**
     * 
     * @var int
     */
    public $totalSessionsWon;

    /**
     * 
     * @var int
     */
    public $totalTripleKills;

    /**
     * 
     * @var int
     */
    public $totalTurretsKilled;

    /**
     * 
     * @var int
     */
    public $totalUnrealKills;

    public function __construct($d) {
        foreach (get_object_vars($d) as $key => $value) {
            $this->$key = $value;
        }
    }

}
