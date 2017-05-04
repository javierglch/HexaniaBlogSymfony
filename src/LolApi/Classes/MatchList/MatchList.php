<?php

namespace LolApi\Classes\MatchList;

/**
 * MatchList
 *
 * @author Javier
 */
class MatchList {

    //rankedQueues
    const RANKEDQUEUE_RANKED_FLEX_SR = 'RANKED_FLEX_SR';
    const RANKEDQUEUE_RANKED_SOLO_5x5 = 'RANKED_SOLO_5x5';
    const RANKEDQUEUE_RANKED_TEAM_3x3 = 'RANKED_TEAM_3x3';
    const RANKEDQUEUE_RANKED_TEAM_5x5 = 'RANKED_TEAM_5x5';
    const RANKEDQUEUE_TEAM_BUILDER_DRAFT_RANKED_5x5 = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
    const RANKEDQUEUE_TEAM_BUILDER_RANKED_SOLO = 'TEAM_BUILDER_RANKED_SOLO';
    //seasons
    const SEASON_PRESEASON3 = 'PRESEASON3';
    const SEASON_SEASON3 = 'SEASON3';
    const SEASON_PRESEASON2014 = 'PRESEASON2014';
    const SEASON_SEASON2014 = 'SEASON2014';
    const SEASON_PRESEASON2015 = 'PRESEASON2015';
    const SEASON_SEASON2015 = 'SEASON2015';
    const SEASON_PRESEASON2016 = 'PRESEASON2016';
    const SEASON_SEASON2016 = 'SEASON2016';
    const SEASON_PRESEASON2017 = 'PRESEASON2017';
    const SEASON_SEASON2017 = 'SEASON2017';

    /**
     * 
     * @var int
     */
    public $endIndex;

    /**
     * 
     * @var MatchReference array List[MatchReference]
     */
    public $matches;

    /**
     * 
     * @var int
     */
    public $startIndex;

    /**
     * 
     * @var int
     */
    public $totalGames;

    function __construct($d) {
        $this->endIndex = $d->endIndex;
        $this->matches = [];
        foreach ($d->matches as $o) {
            $this->matches[] = new MatchReference($o);
        }
        $this->startIndex = $d->startIndex;
        $this->totalGames = $d->totalGames;
    }

}
