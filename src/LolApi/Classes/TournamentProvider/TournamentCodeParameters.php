<?php

namespace LolApi\Classes\TournamentProvider;

/**
 * TournamentCodeParameters
 *
 * @author Javier
 */
class TournamentCodeParameters {

    // ~ maptype ~
    const MAPTYPE_SUMMONERS_RIFT='SUMMONERS_RIFT';
    const MAPTYPE_TWISTED_TREELINE='TWISTED_TREELINE';
    const MAPTYPE_HOWLING_ABYSS='HOWLING_ABYSS';
    
    // ~  pickType ~ 
    const PICKTYPE_BLIND_PICK='BLIND_PICK';
    const PICKTYPE_DRAFT_MODE='DRAFT_MODE';
    const PICKTYPE_ALL_RANDOM='ALL_RANDOM';
    const PICKTYPE_TOURNAMENT_DRAFT='TOURNAMENT_DRAFT';
    
    // ~ SPECTATORTYPE ~ 
    const SPECTATORTYPE_NONE='NONE';
    const SPECTATORTYPE_LOBBYONLY='LOBBYONLY';
    const SPECTATORTYPE_ALL='';
    
    /**
     * Optional list of participants in order to validate the players eligible 
     * to join the lobby. NOTE: We currently do not enforce participants at the 
     * team level, but rather the aggregate of teamOne and teamTwo. We may add 
     * the ability to enforce at the team level in the future.
     * @var SummonerIdParams
     */
    public $allowedSummonerIds;

    /**
     * The map type of the game. Valid values are SUMMONERS_RIFT, TWISTED_TREELINE, and HOWLING_ABYSS.
     * @var string
     */
    public $mapType;

    /**
     * Optional string that may contain any data in any format, if specified at all. Used to denote any custom information about the game.
     * @var string
     */
    public $metadata;

    /**
     * The pick type of the game. Valid values are BLIND_PICK, DRAFT_MODE, ALL_RANDOM, TOURNAMENT_DRAFT.
     * @var string
     */
    public $pickType;

    /**
     * The spectator type of the game. Valid values are NONE, LOBBYONLY, ALL.
     * @var string
     */
    public $spectatorType;

    /**
     * The team size of the game. Valid values are 1-5. 
     * @var int
     */
    public $teamSize;

    function __construct($d) {
        $this->allowedSummonerIds = new SummonerIdParams($d->allowedSummonerIds);
        $this->mapType = $d->mapType;
        $this->metadata = $d->metadata;
        $this->pickType = $d->pickType;
        $this->spectatorType = $d->spectatorType;
        $this->teamSize = $d->teamSize;
    }

}
