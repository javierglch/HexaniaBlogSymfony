<?php

namespace LolApi\Classes\League;

/**
 * LeagueEntryDto
 * This object contains league participant information representing a summoner or team.
 * @author Javier
 */
class LeagueEntryDto {

    //PLAYSTYLE
    const PLAYSTYLE_NONE = 'NONE';
    const PLAYSTYLE_SOLO = 'SOLO';
    const PLAYSTYLE_SQUAD = 'SQUAD';
    const PLAYSTYLE_TEAM = 'TEAM';

    /**
     * The league division of the participant.
     * @var string
     */
    public $division;

    /**
     * Specifies if the participant is fresh blood.
     * @var boolean
     */
    public $isFreshBlood;

    /**
     * Specifies if the participant is on a hot streak.
     * @var boolean
     */
    public $isHotStreak;

    /**
     * Specifies if the participant is inactive.
     * @var boolean
     */
    public $isInactive;

    /**
     * Specifies if the participant is a veteran.
     * @var boolean
     */
    public $isVeteran;

    /**
     * The league points of the participant.
     * @var int
     */
    public $leaguePoints;

    /**
     * The number of losses for the participant.
     * @var int
     */
    public $losses;

    /**
     * Mini series data for the participant. Only present if the participant is currently in a mini series.
     * @var MiniSeriesDto
     */
    public $miniSeries;

    /**
     * The ID of the participant (i.e., summoner or team) represented by this entry.
     * @var string
     */
    public $playerOrTeamId;

    /**
     * The name of the the participant (i.e., summoner or team) represented by this entry.
     * @var string
     */
    public $playerOrTeamName;

    /**
     * The playstyle of the participant. (Legal values: NONE, SOLO, SQUAD, TEAM)
     * @var string
     */
    public $playstyle;

    /**
     * The number of wins for the participant.
     * @var int
     */
    public $wins;

    function __construct($data) {
        $this->division = $data->division;
        $this->isFreshBlood = $data->isFreshBlood;
        $this->isHotStreak = $data->isHotStreak;
        $this->isInactive = $data->isInactive;
        $this->isVeteran = $data->isVeteran;
        $this->leaguePoints = $data->leaguePoints;
        $this->losses = $data->losses;
        $this->miniSeries = new MiniSeriesDto($data->miniSeries);
        $this->playerOrTeamId = $data->playerOrTeamId;
        $this->playerOrTeamName = $data->playerOrTeamName;
        $this->playstyle = $data->playstyle;
        $this->wins = $data->wins;
    }

    
    /** @var \LolApi\Classes\Summoner\SummonerDto */
    private $SummonerDto;

    /**
     * Devuelve los invocadodres buscandolos por id
     * @return \LolApi\Classes\Summoner\SummonerDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDto() {
        if (!$this->SummonerDto) {
            $this->SummonerDto = \LolApi\LolApi::globalApi()->getSummonerDtoById($this->playerOrTeamId);
        }
        return $this->SummonerDto;
    }

    /**
     * Construye la imagen tier (con la division)
     * @param string $tier Tier al que corresponde la liga (por ejemplo, gold, silver, etc) Usar LeagueDto::TIER_...
     * es imprescindible su uso, se puede sacar el objeto anterior (LeagueDto)
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @return ImageTag
     */
    public function getTierDivisionIcon_ImageTag($tier, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->tier_division_icon($tier, $this->division, $imgTitle?$imgTitle:$tier.' '.$this->division, $imgClass, $v, $tooltip);
    }

}
