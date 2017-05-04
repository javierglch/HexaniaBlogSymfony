<?php

namespace LolApi\Classes\LolStaticData;

/**
 * BasicDataDto
 * This object contains basic data.
 * @author Javier
 */
class RuneDto {

    #~ runeData ~#
    
    const RUNELISTDATA_ALL = 'all';
    const RUNELISTDATA_COLLOQ = 'colloq';
    const RUNELISTDATA_CONSUME_ON_FULL = 'consumeOnFull';
    const RUNELISTDATA_CONSUMED = 'consumed';
    const RUNELISTDATA_DEPTH = 'depth';
    const RUNELISTDATA_FROM = 'from';
    const RUNELISTDATA_GOLD = 'gold';
    const RUNELISTDATA_HIDE_FROM_ALL = 'hideFromAll';
    const RUNELISTDATA_IMAGE = 'image';
    const RUNELISTDATA_IN_STORE = 'inStore';
    const RUNELISTDATA_INTO = 'into';
    const RUNELISTDATA_MAPS = 'maps';
    const RUNELISTDATA_REQUIRED_CHAMPION = 'requiredChampion';
    const RUNELISTDATA_SANITIZED_DESCRIPTION = 'sanitizedDescription';
    const RUNELISTDATA_SPECIAL_RECIPE = 'specialRecipe';
    const RUNELISTDATA_STACKS = 'stacks';
    const RUNELISTDATA_STATS = 'stats';
    const RUNELISTDATA_TAGS = 'tags';
    
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
     * @var array List[string]	
     */
    public $from;
    
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
     * 
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
     * @var array string
     */
    public $tags;

    function __construct($data) {
        $this->colloq = $data->colloq;
        $this->consumeOnFull = $data->consumeOnFull;
        $this->consumed = $data->consumed;
        $this->depth = $data->depth;
        $this->description = $data->description;
        $this->from = $data->from;
        $this->group = $data->group;
        $this->hideFromAll = $data->hideFromAll;
        $this->id = $data->id;
        $this->image = new ImageDto($data->image);
        $this->inStore = $data->inStore;
        $this->into = $data->into;
        $this->maps = $data->maps;
        $this->name = $data->name;
        $this->plaintext = $data->plaintext;
        $this->requiredChampion = $data->requiredChampion;
        $this->rune = new MetaDataDto($data->rune);
        $this->sanitizedDescription = $data->sanitizedDescription;
        $this->specialRecipe = $data->specialRecipe;
        $this->stacks = $data->stacks;
        $this->stats = new BasicDataStatsDto($data->stats);
        $this->tags = $data->tags;
    }

    /**
     * construye la imagen de la runa
     * @param string $imgTitle default: name
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip default: description
     * @return ImageTag
     */
    public function getIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->rune($this->image->full, $imgTitle?$imgTitle:$this->name, $imgClass, $v, $tooltip?$tooltip:$this->description);
    }
}
