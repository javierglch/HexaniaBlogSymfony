<?php

namespace LolApi\Classes\Stats;

/**
 * PlayerStatsSummaryListDto
 * This object contains a collection of player stats summary information.
 * @author Javier
 */
class PlayerStatsSummaryListDto {

    Const SEASON_SEASON3 = 'SEASON3';
    const SEASON_SEASON2014 = 'SEASON2014';
    const SEASON_SEASON2015 = 'SEASON2015';
    const SEASON_SEASON2016 = 'SEASON2016';
    const SEASON_SEASON2017 = 'SEASON2017';

    /**
     * Collection of player stats summaries associated with the summoner.
     * @var PlayerStatsSummaryDto array List[PlayerStatsSummaryDto] 
     */
    public $playerStatSummaries;

    /**
     * Summoner ID.
     * @var long 
     */
    public $summonerId;

    public function __construct($d) {
        $this->playerStatSummaries = new PlayerStatsSummaryDto($d->playerStatSummaries);
        $this->summonerId = $d->summonerId;
    }

    /** @var \LolApi\Classes\Summoner\SummonerDto */
    private $SummonerDto;

    /**
     * Devuelve los invocadodres buscandolos por id
     * @param long $summonerId summoner ID associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return SummonerDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDto() {
        if ($this->SummonerDto) {
            $this->SummonerDto = \LolApi\LolApi::globalApi()->getSummonerDtoById($this->summonerId);
        }
        return $this->SummonerDto;
    }

}
