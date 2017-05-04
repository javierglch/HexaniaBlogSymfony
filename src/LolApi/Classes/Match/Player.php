<?php

namespace LolApi\Classes\Match;

/**
 * Player
 * This object contains match player information
 * @author Javier
 */
class Player {

    /**
     * Match history URI
     * @var string 
     */
    public $matchHistoryUri;

    /**
     * Profile icon ID
     * @var int 
     */
    public $profileIcon;

    /**
     * Summoner ID
     * @var long 
     */
    public $summonerId;

    /**
     * Summoner name
     * @var string 
     */
    public $summonerName;

    function __construct($d) {
        $this->matchHistoryUri = $d->matchHistoryUri;
        $this->profileIcon = $d->profileIcon;
        $this->summonerId = $d->summonerId;
        $this->summonerName = $d->summonerName;
    }

    /** @var \LolApi\Classes\Summoner\SummonerDto */
    private $SummonerDto;

    /**
     * Devuelve el invocador
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

    public function getProfileIcon_ImageTag($imgTitle, $imgClass, $v, $tooltip) {
        return \LolApi\LolApi::globalApi()->ImagesApi->profile_icon($this->profileIcon, $imgTitle ? $imgTitle : $this->summonerName, $imgClass, $v, $tooltip);
    }

}
