<?php

namespace LolApi\Classes\CurrentGame;

/**
 * BannedChampion
 *
 * @author Javier
 */
class BannedChampion {

    /**
     * The ID of the banned champion
     * @var long
     */
    public $championId;

    /**
     * The turn during which the champion was banned
     * @var int
     */
    public $pickTurn;

    /**
     * The ID of the team that banned the champion
     * @var long
     */
    public $teamId;

    public function __construct($data) {
        $this->championId = $data->championId;
        $this->pickTurn = $data->pickTurn;
        $this->teamId = $data->teamId;
    }

    /** @var \LolApi\Classes\LolStaticData\ChampionDto */
    private $StaticChampionDto;

    /**
     * Recupera la información de un campeon
     * @param string $champData Usar LolStaticData\ChampionListDto::CHAMPDATA_... para escoger el tag. Tags to return additional data. Only type, version, data, id, key, name, and title are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return LeagueDto
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

}
