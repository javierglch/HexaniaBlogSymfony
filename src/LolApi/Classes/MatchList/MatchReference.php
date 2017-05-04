<?php

namespace LolApi\Classes\MatchList;

/**
 * MatchReference
 *
 * @author Javier
 */
class MatchReference {

    //lane
    const LANE_MID = 'MID';
    const LANE_MIDDLE = 'MIDDLE';
    const LANE_TOP = 'TOP';
    const LANE_JUNGLE = 'JUNGLE';
    const LANE_BOT = 'BOT';
    const LANE_BOTTOM = 'BOTTOM';
    //queue
    const QUEUE_RANKED_FLEX_SR = 'RANKED_FLEX_SR';
    const QUEUE_RANKED_SOLO_5x5 = 'RANKED_SOLO_5x5';
    const QUEUE_RANKED_TEAM_3x3 = 'RANKED_TEAM_3x3';
    const QUEUE_RANKED_TEAM_5x5 = 'RANKED_TEAM_5x5';
    const QUEUE_TEAM_BUILDER_DRAFT_RANKED_5x5 = 'TEAM_BUILDER_DRAFT_RANKED_5x5';
    const QUEUE_TEAM_BUILDER_RANKED_SOLO = 'TEAM_BUILDER_RANKED_SOLO';
    //region
    const REGION_BR = 'br';
    const REGION_EUNE = 'eune';
    const REGION_EUW = 'euw';
    const REGION_JP = 'jp';
    const REGION_KR = 'kr';
    const REGION_LAN = 'lan';
    const REGION_LAS = 'las';
    const REGION_NA = 'na';
    const REGION_OCE = 'oce';
    const REGION_RU = 'ru';
    const REGION_TR = 'tr';
    //role
    const ROLE_DUO = 'DUO';
    const ROLE_NONE = 'NONE';
    const ROLE_SOLO = 'SOLO';
    const ROLE_DUO_CARRY = 'DUO_CARRY';
    const ROLE_DUO_SUPPORT = 'DUO_SUPPORT';
    //season
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
     * @var long
     */
    public $champion;

    /**
     * Legal values: MID, MIDDLE, TOP, JUNGLE, BOT, BOTTOM
     * @var string
     */
    public $lane;

    /**
     * 
     * @var long
     */
    public $matchId;

    /**
     * 
     * @var string
     */
    public $platformId;

    /**
     * Legal values: RANKED_FLEX_SR, RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5, TEAM_BUILDER_DRAFT_RANKED_5x5, TEAM_BUILDER_RANKED_SOLO
     * @var string
     */
    public $queue;

    /**
     * Legal values: br, eune, euw, jp, kr, lan, las, na, oce, ru, tr
     * @var string
     */
    public $region;

    /**
     * Legal values: DUO, NONE, SOLO, DUO_CARRY, DUO_SUPPORT
     * @var string
     */
    public $role;

    /**
     * 
     * @var string
     */
    public $season;

    /**
     * Legal values: PRESEASON3, SEASON3, PRESEASON2014, SEASON2014, PRESEASON2015, SEASON2015, PRESEASON2016, SEASON2016, PRESEASON2017, SEASON2017
     * @var long
     */
    public $timestamp;

    function __construct($d) {
        foreach (get_object_vars($d) as $key => $value) {
            $this->$key = $value;
        }
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

    /**
     * @var \LolApi\Classes\Match\MatchDetail 
     */
    private $MatchDetail;

    /**
     * Recupera el detalle de una partida segun su matchId (normalmente solo es para partidas ranked)
     * @param boolean $includeTimeline
     * @return \LolApi\Classes\Match\MatchDetail
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMatchDetailDto($includeTimeline = null) {
        if (!$this->MatchDetail) {
            $this->MatchDetail = \LolApi\LolApi::globalApi()->getMatchDetail($this->matchId, $includeTimeline);
        }
        return $this->MatchDetail;
    }

}
