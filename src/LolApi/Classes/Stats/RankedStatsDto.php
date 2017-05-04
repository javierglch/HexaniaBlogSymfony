<?php

namespace LolApi\Classes\Stats;

/**
 * RankedStatsDto
 * This object contains ranked stats information.
 * @author Javier
 */
class RankedStatsDto {

    const SEASON_SEASON3 = 'SEASON3';
    const SEASON_SEASON2014 = 'SEASON2014';
    const SEASON_SEASON2015 = 'SEASON2015';
    const SEASON_SEASON2016 = 'SEASON2016';
    const SEASON_SEASON2017 = 'SEASON2017';

    /**
     * Collection of aggregated stats summarized by champion.
     * @var ChampionStatsDto array List[ChampionStatsDto] 
     */
    public $champions;

    /**
     * Date stats were last modified specified as epoch milliseconds.
     * @var long 
     */
    public $modifyDate;

    /**
     * Summoner ID.
     * @var long 
     */
    public $summonerId;

    public function __construct($d) {
        $this->champions = [];
        foreach ($d->champions as $o) {
            $this->champions[] = new ChampionStatsDto($o);
        }
        $this->modifyDate = $d->modifyDate;
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

    /**
     * Devuelve las estadisticas del campeon dado. Recorre todos los objetos del array ->champions
     * @param int $championId Usar "0" para devolver las estadisticas globales.
     * @return ChampionStatsDto
     */
    public function getStatsOfChampion($championId) {
        foreach ($this->champions as $key => $championstats) {
            if ($championstats->id == $championId) {
                return $championstats;
            }
        }
        return null;
    }

}
