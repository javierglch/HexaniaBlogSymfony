<?php

namespace LolApi\Classes\Stats;

/**
 * ChampionStatsDto
 * This object contains a collection of champion stats information.
 * @author Javier
 */
class ChampionStatsDto {

    /**
     * Champion ID. Note that champion ID 0 represents the combined stats for all champions. For static information correlating to champion IDs, please refer to the LoL Static Data API.
     * @var int 
     */
    public $id;

    /**
     * Aggregated stats associated with the champion.
     * @var AggregatedStatsDto 
     */
    public $stats;

    public function __construct($d) {
        $this->id = $d->id;
        $this->stats = new AggregatedStatsDto($d->stats);
    }

    /** @var LolApi\Classes\LolStaticData\ChampionDto */
    private $ChampionDto;

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
    public function getChampionDto($champData = null, $locale = null, $version = null) {
        if (!$this->ChampionDto) {
            $this->ChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->id, $champData, $locale, $version);
        }
        return $this->ChampionDto;
    }

}
