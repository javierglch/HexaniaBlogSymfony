<?php

namespace LolApi\Classes\Summoner;

/**
 * MasteryPagesDto
 * This object contains masteries information.
 * @author Javier
 */
class MasteryPagesDto {

    /**
     * Collection of mastery pages associated with the summoner.
     * @var array Set[MasteryPageDto] 
     */
    public $pages;

    /**
     * Summoner ID.
     * @var long 
     */
    public $summonerId;

    public function __construct($d) {
        $this->pages = [];
        foreach ($d->pages as $key => $o) {
            $this->pages[$key] = new MasteryPageDto($o);
        }
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
