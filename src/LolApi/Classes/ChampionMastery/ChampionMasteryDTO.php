<?php

namespace LolApi\Classes\ChampionMastery;

/**
 * ChampionMasteryDTO
 *
 * @author Javier
 */
class ChampionMasteryDTO {

    /**
     * Champion ID for this entry.
     * @var long
     */
    public $championId;

    /**
     * Champion level for specified player and champion combination.
     * @var int
     */
    public $championLevel;

    /**
     * Total number of champion points for this player and champion combination - they are used to determine championLevel.
     * @var int
     */
    public $championPoints;

    /**
     * Number of points earned since current level has been achieved. Zero if player reached maximum champion level for this champion.
     * @var long
     */
    public $championPointsSinceLastLevel;

    /**
     * Number of points needed to achieve next level. Zero if player reached maximum champion level for this champion.
     * @var long
     */
    public $championPointsUntilNextLevel;

    /**
     * Is chest granted for this champion or not in current season.
     * @var boolean
     */
    public $chestGranted;

    /**
     * Last time this champion was played by this player - in Unix milliseconds time format.
     * @var long
     */
    public $lastPlayTime;

    /**
     * Player ID for this entry.
     * @var long	
     */
    public $playerId;

    public function __construct($data) {
        foreach (get_object_vars($data) as $key => $value) {
            $this->$key = $value;
        }
    }

    /** @var \LolApi\Classes\LolStaticData\ChampionDto */
    private $StaticChampionDto;

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
    public function getStaticChampionDto($champData = null, $locale = null, $version = null) {
        if (!$this->StaticChampionDto) {
            $this->StaticChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->championId, $champData, $locale, $version);
        }
        return $this->StaticChampionDto;
    }

    /**
     * @var SummonerDto
     */
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
            $this->SummonerDto = \LolApi\LolApi::globalApi()->getSummonerDtoById($this->playerId);
        }
        return $this->SummonerDto;
    }

}
