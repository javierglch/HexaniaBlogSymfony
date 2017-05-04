<?php

namespace LolApi\Classes\Match;

/**
 * BannedChampion
 *
 * @author Javier
 */
class BannedChampion {

    /**
     * 	Banned champion ID
     * @var int 
     */
    public $championId;

    /**
     * Turn during which the champion was banned
     * @var int 
     */
    public $pickTurn;

    function __construct($d) {
        $this->championId = $d->championId;
        $this->pickTurn = $d->pickTurn;
    }

    /** @var \LolApi\Classes\LolStaticData\ChampionDto */
    private $ChampionDto;

    /**
     * Recupera el championdto del bannedchampion a traves de la id championId
     * @return \LolApi\Classes\LolStaticData\ChampionDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getChampionDto($champData = null, $locale = null, $version = null) {
        if ($this->ChampionDto) {
            $this->ChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->championId, $champData, $locale, $version);
        }
        return $this->ChampionDto;
    }

}
