<?php

namespace LolApi\Classes\Summoner;

/**
 * RunePagesDto
 *
 * @author Javier
 */
class RunePagesDto {

    /**
     * Collection of rune pages associated with the summoner.
     * @var RunePageDto array Set[RunePageDto]
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
            $this->pages[$key] = new RunePageDto($o);
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
