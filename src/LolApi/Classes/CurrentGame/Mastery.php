<?php

namespace LolApi\Classes\CurrentGame;

/**
 * Mastery
 *
 * @author Javier
 */
class Mastery {

    /**
     * The ID of the mastery
     * @var long 
     */
    public $masteryId;

    /**
     * 	The number of points put into this mastery by the user
     * @var int 
     */
    public $rank;

    public function __construct($data) {
        $this->masteryId = $data->masteryId;
        $this->rank = $data->rank;
    }

    /** @var \LolApi\Classes\LolStaticData\MasteryDto */
    private $MasteryDto;

    /**
     * Devuelve la información de la runa buscada
     * @param string $id Mastery ID
     * @param string $masteryData Usar MasteryDto::MASTERYDATA_... Tags to return additional data. Only type, version, data, id, name, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return \LolApi\Classes\LolStaticData\MasteryDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMasteryDto($masteryData = null, $locale = null, $version = null) {
        if (!$this->MasteryDto) {
            $this->MasteryDto = \LolApi\LolApi::globalApi()->getMasteryDto($this->masteryId, $masteryData, $locale, $version);
        }
        return $this->MasteryDto;
    }

}
