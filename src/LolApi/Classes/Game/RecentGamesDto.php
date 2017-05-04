<?php

namespace LolApi\Classes\Game;

/**
 * RecentGamesDto
 * This object contains recent games information.
 * @author Javier
 */
class RecentGamesDto {

    /**
     * 	Collection of recent games played (max 10)
     * @var GameDto array 
     */
    public $games;

    /**
     * Summoner ID.
     * @var long 
     */
    public $summonerId;

    public function __construct($data) {
        $this->games = [];
        foreach ($data->games as $o) {
            $this->games[] = new GameDto($o);
        }
        $this->summonerId = $data->summonerId;
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
            $this->SummonerDto = \LolApi\LolApi::globalApi()->getSummonerDtoById($this->summonerId);
        }
        return $this->SummonerDto;
    }
    
    

}
