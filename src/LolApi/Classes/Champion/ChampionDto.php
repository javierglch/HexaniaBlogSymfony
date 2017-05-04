<?php

namespace LolApi\Classes\Champion;

/**
 * ChampionListDto
 *
 * @author Javier
 */
class ChampionDto {

    /**
     * Indicates if the champion is active.
     * @var boolean 
     */
    public $active;

    /**
     * Bot enabled flag (for custom games).
     * @var boolean 
     */
    public $botEnabled;

    /**
     * Bot Match Made enabled flag (for Co-op vs. AI games).
     * @var boolean 
     */
    public $botMmEnabled;

    /**
     * Indicates if the champion is free to play. Free to play champions are rotated periodically.
     * @var boolean 
     */
    public $freeToPlay;

    /**
     * Champion ID. For static information correlating to champion IDs, please refer to the LoL Static Data API.
     * @var long 
     */
    public $id;

    /**
     * Ranked play enabled flag.
     * @var boolean 
     */
    public $rankedPlayEnabled;

    public function __construct($data) {
        $this->active = $data->active;
        $this->botEnabled = $data->botEnabled;
        $this->botMmEnabled = $data->botMmEnabled;
        $this->freeToPlay = $data->freeToPlay;
        $this->id = $data->id;
        $this->rankedPlayEnabled = $data->rankedPlayEnabled;
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
            $this->StaticChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->id, $champData, $locale, $version);
        }
        return $this->StaticChampionDto;
    }

}
