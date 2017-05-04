<?php

namespace LolApi\Classes\LolStaticData;

/**
 * BlockItemDto
 * This object contains champion recommended block item data.
 * @author Javier
 */
class BlockItemDto {
    
    /** @var int */
    public $count;
    /** @var int */
    public $id;
    
    function __construct($d) {
        $this->count = $d->count;
        $this->id = $d->id;
    }
    
    /**
     * @var ItemDto
     */
    private $ItemDto;
    
    /**
     * Devuelve el itemdto en cuestion a traves de la id
     * @param string $itemData Use ItemDto::ITEMDATA_... Tags to return additional data. Only id, name, plaintext, group, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return ItemDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getItemDto($itemData=null, $locale=null, $version=null){
        if(!$this->ItemDto){
            $this->ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->id, $itemData, $locale, $version);
        }
        return $this->ItemDto;
    }

}
