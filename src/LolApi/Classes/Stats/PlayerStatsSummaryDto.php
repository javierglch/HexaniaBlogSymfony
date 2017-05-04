<?php

namespace LolApi\Classes\Stats;

/**
 * PlayerStatsSummaryDto
 * This object contains player stats summary information.
 * @author Javier
 */
class PlayerStatsSummaryDto {

    
    const PLAYERSTATSUMMARYTYPE_AramUnranked5x5='AramUnranked5x5';
    const PLAYERSTATSUMMARYTYPE_Ascension='Ascension';
    const PLAYERSTATSUMMARYTYPE_Bilgewater='Bilgewater';
    const PLAYERSTATSUMMARYTYPE_CAP5x5='CAP5x5';
    const PLAYERSTATSUMMARYTYPE_CoopVsAI='CoopVsAI';
    const PLAYERSTATSUMMARYTYPE_CoopVsAI3x3='CoopVsAI3x3';
    const PLAYERSTATSUMMARYTYPE_CounterPick='CounterPick';
    const PLAYERSTATSUMMARYTYPE_FirstBlood1x1='FirstBlood1x1';
    const PLAYERSTATSUMMARYTYPE_FirstBlood2x2='FirstBlood2x2';
    const PLAYERSTATSUMMARYTYPE_Hexakill='Hexakill';
    const PLAYERSTATSUMMARYTYPE_KingPoro='KingPoro';
    const PLAYERSTATSUMMARYTYPE_NightmareBot='NightmareBot';
    const PLAYERSTATSUMMARYTYPE_OdinUnranked='OdinUnranked';
    const PLAYERSTATSUMMARYTYPE_OneForAll5x5='OneForAll5x5';
    const PLAYERSTATSUMMARYTYPE_RankedPremade3x3='RankedPremade3x3';
    const PLAYERSTATSUMMARYTYPE_RankedPremade5x5='RankedPremade5x5';
    const PLAYERSTATSUMMARYTYPE_RankedSolo5x5='RankedSolo5x5';
    const PLAYERSTATSUMMARYTYPE_RankedTeam3x3='RankedTeam3x3';
    const PLAYERSTATSUMMARYTYPE_RankedTeam5x5='RankedTeam5x5';
    const PLAYERSTATSUMMARYTYPE_SummonersRift6x6='SummonersRift6x6';
    const PLAYERSTATSUMMARYTYPE_Unranked='Unranked';
    const PLAYERSTATSUMMARYTYPE_Unranked3x3='Unranked3x3';
    const PLAYERSTATSUMMARYTYPE_URF='URF';
    const PLAYERSTATSUMMARYTYPE_URFBots='URFBots';
    const PLAYERSTATSUMMARYTYPE_Siege='Siege';
    const PLAYERSTATSUMMARYTYPE_RankedFlexSR='RankedFlexSR';
    const PLAYERSTATSUMMARYTYPE_RankedFlexTT='RankedFlexTT';
    
    /**
     * Aggregated stats.
     * @var AggregatedStatsDto 
     */
    public $aggregatedStats;

    /**
     * Number of losses for this queue type. Returned for ranked queue types only.
     * @var int 
     */
    public $losses;

    /**
     * Date stats were last modified specified as epoch milliseconds.
     * @var long 
     */
    public $modifyDate;

    /**
     * Player stats summary type. (Legal values: AramUnranked5x5, Ascension, Bilgewater, CAP5x5, CoopVsAI, CoopVsAI3x3, CounterPick, FirstBlood1x1, FirstBlood2x2, Hexakill, KingPoro, NightmareBot, OdinUnranked, OneForAll5x5, RankedPremade3x3, RankedPremade5x5, RankedSolo5x5, RankedTeam3x3, RankedTeam5x5, SummonersRift6x6, Unranked, Unranked3x3, URF, URFBots, Siege, RankedFlexSR, RankedFlexTT)
     * @var string 
     */
    public $playerStatSummaryType;

    /**
     * Number of wins for this queue type.
     * @var int 
     */
    public $wins;

    public function __construct($d) {
        $this->aggregatedStats = new AggregatedStatsDto($d->aggregatedStats);
        $this->losses = $d->losses;
        $this->modifyDate = $d->modifyDate;
        $this->playerStatSummaryType = $d->playerStatSummaryType;
        $this->wins = $d->wins;
    }

}
