<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\Classes\Summoner;

/**
 * Description of RuneSlotDto
 *
 * @author Javier
 */
class RuneSlotDto {

    /**
     * Rune ID associated with the rune slot. For static information correlating to rune IDs, please refer to the LoL Static Data API.
     * @var int 
     */
    public $runeId;

    /**
     * Rune slot ID.
     * @var int
     */
    public $runeSlotId;

    public function __construct($d) {
        $this->runeId = $d->runeId;
        $this->runeSlotId = $rd->uneSlotId;
    }

    /** @var LolApi\Classes\LolStaticData\MasteryDto */
    private $RuneDto;

    /**
     * Devuelve la información de la runa buscada
     * @param string $masteryData Usar MasteryDto::MASTERYDATA_... Tags to return additional data. Only type, version, data, id, name, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return RuneDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getStaticRuneDto($masteryData = null, $locale = null, $version = null) {
        if (!$this->RuneDto) {
            $this->RuneDto = \LolApi\LolApi::globalApi()->getRuneDto($this->id, $masteryData, $locale, $version);
        }
        return $this->RuneDto;
    }

}
