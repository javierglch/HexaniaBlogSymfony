<?php

namespace LolApi\Classes\Match;

/**
 * MatchDetail
 * This object contains match detail information
 * @author Javier
 */
class MatchDetail {

    const MATCHMODE_CLASSIC = 'CLASSIC';
    const MATCHMODE_ODIN = 'ODIN';
    const MATCHMODE_ARAM = 'ARAM';
    const MATCHMODE_TUTORIAL = 'TUTORIAL';
    const MATCHMODE_ONEFORALL = 'ONEFORALL';
    const MATCHMODE_ASCENSION = 'ASCENSION';
    const MATCHMODE_FIRSTBLOOD = 'FIRSTBLOOD';
    const MATCHMODE_KINGPORO = 'KINGPORO';
    const MATCHMODE_SIEGE = 'SIEGE';
    const MATCHTYPE_CUSTOM_GAME = 'CUSTOM_GAME';
    const MATCHTYPE_MATCHED_GAME = 'MATCHED_GAME';
    const MATCHTYPE_TUTORIAL_GAME = 'TUTORIAL_GAME';
    const QUEUETYPE_CUSTOM = 'CUSTOM';
    const QUEUETYPE_NORMAL_5x5_BLIND = 'NORMAL_5x5_BLIND';
    const QUEUETYPE_RANKED_SOLO_5x5 = 'RANKED_SOLO_5x5';
    const QUEUETYPE_RANKED_PREMADE_5x5 = 'RANKED_PREMADE_5x5';
    const QUEUETYPE_BOT_5x5 = 'BOT_5x5';
    const QUEUETYPE_NORMAL_3x3 = 'NORMAL_3x3';
    const QUEUETYPE_RANKED_PREMADE_3x3 = 'RANKED_PREMADE_3x3';
    const QUEUETYPE_NORMAL_5x5_DRAFT = 'NORMAL_5x5_DRAFT';
    const QUEUETYPE_ODIN_5x5_BLIND = 'ODIN_5x5_BLIND';
    const QUEUETYPE_ODIN_5x5_DRAFT = 'ODIN_5x5_DRAFT';
    const QUEUETYPE_BOT_ODIN_5x5 = 'BOT_ODIN_5x5';
    const QUEUETYPE_BOT_5x5_INTRO = 'BOT_5x5_INTRO';
    const QUEUETYPE_BOT_5x5_BEGINNER = 'BOT_5x5_BEGINNER';
    const QUEUETYPE_BOT_5x5_INTERMEDIATE = 'BOT_5x5_INTERMEDIATE';
    const QUEUETYPE_RANKED_TEAM_3x3 = 'RANKED_TEAM_3x3';
    const QUEUETYPE_RANKED_TEAM_5x5 = 'RANKED_TEAM_5x5';
    const QUEUETYPE_BOT_TT_3x3 = 'BOT_TT_3x3';
    const QUEUETYPE_GROUP_FINDER_5x5 = 'GROUP_FINDER_5x5';
    const QUEUETYPE_ARAM_5x5 = 'ARAM_5x5';
    const QUEUETYPE_ONEFORALL_5x5 = 'ONEFORALL_5x5';
    const QUEUETYPE_FIRSTBLOOD_1x1 = 'FIRSTBLOOD_1x1';
    const QUEUETYPE_FIRSTBLOOD_2x2 = 'FIRSTBLOOD_2x2';
    const QUEUETYPE_SR_6x6 = 'SR_6x6';
    const QUEUETYPE_URF_5x5 = 'URF_5x5';
    const QUEUETYPE_ONEFORALL_MIRRORMODE_5x5 = 'ONEFORALL_MIRRORMODE_5x5';
    const QUEUETYPE_BOT_URF_5x5 = 'BOT_URF_5x5';
    const QUEUETYPE_NIGHTMARE_BOT_5x5_RANK1 = 'NIGHTMARE_BOT_5x5_RANK1';
    const QUEUETYPE_NIGHTMARE_BOT_5x5_RANK2 = 'NIGHTMARE_BOT_5x5_RANK2';
    const QUEUETYPE_NIGHTMARE_BOT_5x5_RANK5 = 'NIGHTMARE_BOT_5x5_RANK5';
    const QUEUETYPE_ASCENSION_5x5 = 'ASCENSION_5x5';
    const QUEUETYPE_HEXAKILL = 'HEXAKILL';
    const QUEUETYPE_BILGEWATER_ARAM_5x5 = 'BILGEWATER_ARAM_5x5';
    const QUEUETYPE_KING_PORO_5x5 = 'KING_PORO_5x5';
    const QUEUETYPE_COUNTER_PICK = 'COUNTER_PICK';
    const QUEUETYPE_BILGEWATER_5x5 = 'BILGEWATER_5x5';
    const QUEUETYPE_SIEGE = 'SIEGE';
    const QUEUETYPE_DEFINITELY_NOT_DOMINION_5x5 = 'DEFINITELY_NOT_DOMINION_5x5';
    const QUEUETYPE_ARURF_5X5 = 'ARURF_5X5';
    const QUEUETYPE_TEAM_BUILDER_DRAFT_UNRANKED_5x5 = 'TEAM_BUILDER_DRAFT_UNRANKED_5x5';
    const QUEUETYPE_TEAM_BUILDER_DRAFT_RANKED_5x5 = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
    const QUEUETYPE_TEAM_BUILDER_RANKED_SOLO = 'TEAM_BUILDER_RANKED_SOLO';
    const QUEUETYPE_RANKED_FLEX_SR = 'RANKED_FLEX_SR';
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
     * Match map ID
     * @var int
     */
    public $mapId;

    /**
     * Match creation time. Designates when the team select lobby is created and/or the match is made through match making, not when the game actually starts.
     * @var long
     */
    public $matchCreation;

    /**
     * Match duration
     * @var long
     */
    public $matchDuration;

    /**
     * long
     * @var ID of the match
     */
    public $matchId;

    /**
     * Match mode (Legal values: CLASSIC, ODIN, ARAM, TUTORIAL, ONEFORALL, ASCENSION, FIRSTBLOOD, KINGPORO, SIEGE)
     * @var string
     */
    public $matchMode;

    /**
     * Match type (Legal values: CUSTOM_GAME, MATCHED_GAME, TUTORIAL_GAME)
     * @var string
     */
    public $matchType;

    /**
     * Match version
     * @var string
     */
    public $matchVersion;

    /**
     * Participant identity information
     * @var ParticipantIdentity List[ParticipantIdentity]
     */
    public $participantIdentities;

    /**
     * Participant information
     * @var List[Participant]
     */
    public $participants;

    /**
     * Platform ID of the match
     * @var string
     */
    public $platformId;

    /**
     * Match queue type (Legal values: CUSTOM, NORMAL_5x5_BLIND, RANKED_SOLO_5x5, RANKED_PREMADE_5x5, BOT_5x5, NORMAL_3x3, RANKED_PREMADE_3x3, NORMAL_5x5_DRAFT, ODIN_5x5_BLIND, ODIN_5x5_DRAFT, BOT_ODIN_5x5, BOT_5x5_INTRO, BOT_5x5_BEGINNER, BOT_5x5_INTERMEDIATE, RANKED_TEAM_3x3, RANKED_TEAM_5x5, BOT_TT_3x3, GROUP_FINDER_5x5, ARAM_5x5, ONEFORALL_5x5, FIRSTBLOOD_1x1, FIRSTBLOOD_2x2, SR_6x6, URF_5x5, ONEFORALL_MIRRORMODE_5x5, BOT_URF_5x5, NIGHTMARE_BOT_5x5_RANK1, NIGHTMARE_BOT_5x5_RANK2, NIGHTMARE_BOT_5x5_RANK5, ASCENSION_5x5, HEXAKILL, BILGEWATER_ARAM_5x5, KING_PORO_5x5, COUNTER_PICK, BILGEWATER_5x5, SIEGE, DEFINITELY_NOT_DOMINION_5x5, ARURF_5X5, TEAM_BUILDER_DRAFT_UNRANKED_5x5, TEAM_BUILDER_DRAFT_RANKED_5x5, TEAM_BUILDER_RANKED_SOLO, RANKED_FLEX_SR)
     * @var string
     */
    public $queueType;

    /**
     * Region where the match was played (Legal values: br, eune, euw, jp, kr, lan, las, na, oce, ru, tr)
     * @var string
     */
    public $region;

    /**
     * Season match was played (Legal values: PRESEASON3, SEASON3, PRESEASON2014, SEASON2014, PRESEASON2015, SEASON2015, PRESEASON2016, SEASON2016, PRESEASON2017, SEASON2017)
     * @var string
     */
    public $season;

    /**
     * Team information
     * @var Team List[Team]
     */
    public $teams;

    /**
     * Match timeline data (not included by default)
     * @var Timeline
     */
    public $timeline;

    public function __construct($d) {
        $this->mapId = $d->mapId;
        $this->matchCreation = $d->matchCreation;
        $this->matchDuration = $d->matchDuration;
        $this->matchId = $d->matchId;
        $this->matchMode = $d->matchMode;
        $this->matchType = $d->matchType;
        $this->matchVersion = $d->matchVersion;
        $this->participantIdentities = [];
        foreach ($d->participantIdentities as $o) {
            $this->participantIdentities[] = new ParticipantIdentity($o);
        }
        $this->participants = [];
        foreach ($d->participants as $o) {
            $this->participants[] = new Participant($o);
        }
        $this->platformId = $d->platformId;
        $this->queueType = $d->queueType;
        $this->region = $d->region;
        $this->season = $d->season;
        $this->teams = [];
        foreach ($d->teams as $o) {
            $this->teams[] = new Team($o);
        }
        $this->timeline = new Timeline($d->timeline);
    }

    private $SummonersDtos;

    /**
     * Devuelve la lista de summoners involucrados en la partida 
     * @return SummonersDto array
     */
    public function getSummonersDtos() {
        if (!$this->SummonersDtos) {
            $summonerIds = array_map(function($object){
                return $object->player->summonerId;
            }, $this->participantIdentities);
            $this->SummonersDtos = \LolApi\LolApi::globalApi()->getSummonerDtoByIds($summonerIds);
        }
        return $this->SummonersDtos;
    }

    /**
     *
     * @var \LolApi\Classes\LolStaticData\MapDetailsDto
     */
    private $MapDetailsDto;

    public function getMapDto($locale, $version) {
        if (!$this->MapDetailsDto) {
            $mapDataDto_data = \LolApi\LolApi::globalApi()->getMapDataDto($locale, $version)->data;
            $this->MapDetailsDto = isset($mapDataDto_data[$this->mapId]) ? $mapDataDto_data[$this->mapId] : null;
        }
        return $this->MapDetailsDto;
    }

    /**
     *
     * @var \LolApi\Classes\LolStaticData\ChampionDto 
     */
    private $ChampionDto;

    /**
     * Recupera la información de un campeon
     * @param string $champData Usar LolStaticData\ChampionListDto::CHAMPDATA_... para escoger el tag. Tags to return additional data. Only type, version, data, id, key, name, and title are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return \LolApi\Classes\LolStaticData\ChampionDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getChampionDto($champData = null, $locale = null, $version = null) {
        if ($this->ChampionDto != null) {
            $this->ChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->champion, $champData, $locale, $version);
        }
        return $this->ChampionDto;
    }

}
