<?php

namespace LolApi\Classes\LolStaticData;

/**
 * BasicDataDto
 * This object contains basic data.
 * @author Javier
 */
class BasicDataDto {

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
        $this->gold = new GoldDto($data->gold);
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

}
