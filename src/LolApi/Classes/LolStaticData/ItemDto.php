<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ItemDto
 * This object contains item data.
 * @author Javier
 */
class ItemDto {

    const ITEMDATA_ALL = 'all';
    const ITEMDATA_COLLOQ = 'colloq';
    const ITEMDATA_CONSUME_ON_FULL = 'consumeOnFull';
    const ITEMDATA_CONSUMED = 'consumed';
    const ITEMDATA_DEPTH = 'depth';
    const ITEMDATA_EFFECT = 'effect';
    const ITEMDATA_FROM = 'from';
    const ITEMDATA_GOLD = 'gold';
    const ITEMDATA_HIDE_FROM_ALL = 'hideFromAll';
    const ITEMDATA_IMAGE = 'image';
    const ITEMDATA_IN_STORE = 'inStore';
    const ITEMDATA_INTO = 'into';
    const ITEMDATA_MAPS = 'maps';
    const ITEMDATA_REQUIRED_CHAMPION = 'requiredChampion';
    const ITEMDATA_SANITIZED_DESCRIPTION = 'sanitizedDescription';
    const ITEMDATA_SPECIAL_RECIPE = 'specialRecipe';
    const ITEMDATA_STACKS = 'stacks';
    const ITEMDATA_STATS = 'stats';
    const ITEMDATA_TAGS = 'tags';

    /**
     * 
     * @var string
     */
    public $colloq;

    /**
     * 
     * @var boolean
     */
    public $consumeOnFull;

    /**
     * 
     * @var boolean
     */
    public $consumed;

    /**
     * 
     * @var int
     */
    public $depth;

    /**
     * 
     * @var string
     */
    public $description;

    /**
     * 
     * @var array Map[string, string]	
     */
    public $effect;

    /**
     * 
     * @var array List[string]
     */
    public $from;

    /**
     * Data Dragon includes the gold field for basic data, which is shared by both rune and item. However, only items have a gold field on them, representing their gold cost in the store. Since runes are not sold in the store, they have no gold cost.
     * @var GoldDto
     */
    public $gold;

    /**
     * 
     * @var string
     */
    public $group;

    /**
     * 
     * @var boolean
     */
    public $hideFromAll;

    /**
     * 
     * @var int
     */
    public $id;

    /**
     * 
     * @var ImageDto
     */
    public $image;

    /**
     * 
     * @var boolean
     */
    public $inStore;

    /**
     * Lista de items en los que se puede transformar este al upgradearse
     * @var array List[string]
     */
    public $into;

    /**
     * 
     * @var array Map[string, boolean]
     */
    public $maps;

    /**
     * 
     * @var string
     */
    public $name;

    /**
     * 
     * @var string
     */
    public $plaintext;

    /**
     * 
     * @var string
     */
    public $requiredChampion;

    /**
     * 
     * @var MetaDataDto
     */
    public $rune;

    /**
     * 
     * @var string
     */
    public $sanitizedDescription;

    /**
     * 
     * @var int
     */
    public $specialRecipe;

    /**
     * 
     * @var int
     */
    public $stacks;

    /**
     * 
     * @var BasicDataStatsDto
     */
    public $stats;

    /**
     * 
     * @var array List[string]
     */
    public $tags;

    function __construct($d) {
        $this->colloq = $d->colloq;
        $this->consumeOnFull = $d->consumeOnFull;
        $this->consumed = $d->consumed;
        $this->depth = $d->depth;
        $this->description = $d->description;
        $this->effect = $d->effect;
        $this->from = $d->from;
        $this->gold = new GoldDto($d->gold);
        $this->group = $d->group;
        $this->hideFromAll = $d->hideFromAll;
        $this->id = $d->id;
        $this->image = new ImageDto($d->image);
        $this->inStore = $d->inStore;
        $this->into = $d->into;
        $this->maps = $d->maps;
        $this->name = $d->name;
        $this->plaintext = $d->plaintext;
        $this->requiredChampion = $d->requiredChampion;
        $this->rune = new MetaDataDto($d->rune);
        $this->sanitizedDescription = $d->sanitizedDescription;
        $this->specialRecipe = $d->specialRecipe;
        $this->stacks = $d->stacks;
        $this->stats = new BasicDataStatsDto($d->stats);
        $this->tags = $d->tags;
    }

    /**
     * construye la imagen del item
     * @param int $id
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->item($this->id, $imgTitle ? $imgTitle : $this->name, $imgClass, $v, $tooltip);
    }

    /**
     * contiene un array de objetos ItemDto que proviene de las ids alojadas en la variable ->into
     * @var ItemDto array  
     */
    private $aIntoItemsDto;

    /**
     * Devuelve un array de objetos ItemDto que proviene de las ids alojadas en la variable ->into
     * @param int $id Item ID
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
    public function getInto_ItemsDto_List($itemData = null, $locale = null, $version = null) {
        if (!$this->aIntoItemsDto) {
            $this->aIntoItemsDto = [];
            foreach ($this->into as $itemId) {
                $this->aIntoItemsDto[] = \LolApi\LolApi::globalApi()->getStaticItemDto($itemId, $itemData, $locale, $version);
            }
        }
        return $this->aIntoItemsDto;
    }

    /**
     * contiene un array de objetos ItemDto que proviene de las ids alojadas en la variable ->from
     * @var ItemDto array  
     */
    private $aFromItemsDto;

    /**
     * Devuelve un array de objetos ItemDto que proviene de las ids alojadas en la variable ->from
     * @param int $id Item ID
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
    public function getFromItemsDtoList($itemData = null, $locale = null, $version = null) {
        if (!$this->aFromItemsDto) {
            $this->aFromItemsDto = [];
            foreach ($this->from as $itemId) {
                $this->aFromItemsDto[] = \LolApi\LolApi::globalApi()->getStaticItemDto($itemId, $itemData, $locale, $version);
            }
        }
        return $this->aFromItemsDto;
    }

    /**
     * Objeto creado a partir de la id del item de la variable ->specialRecipe
     * @var ItemDto array  
     */
    private $specialRecipeItemDto;

    /**
     * Devuelve el item con el que se convina
     * @param int $id Item ID
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
    public function getSpecialRecipeItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->specialRecipeItemDto) {
            $this->specialRecipeItemDto[] = \LolApi\LolApi::globalApi()->getStaticItemDto($this->specialRecipe, $itemData, $locale, $version);
        }
        return $this->specialRecipeItemDto;
    }

}
