<?php

namespace LolApi\Classes\LolStaticData;

/**
 * SummonerSpellDto
 * This object contains summoner spell data.
 * @author Javier
 */
class SummonerSpellDto {

    //~ spellData ~
    const SPELLDATA_ALL = 'all';
    const SPELLDATA_COOLDOWN = 'cooldown';
    const SPELLDATA_COOLDOWN_BURN = 'cooldownBurn';
    const SPELLDATA_COST = 'cost';
    const SPELLDATA_COST_BURN = 'costBurn';
    const SPELLDATA_COST_TYPE = 'costType';
    const SPELLDATA_EFFECT = 'effect';
    const SPELLDATA_EFFECT_BURN = 'effectBurn';
    const SPELLDATA_IMAGE = 'image';
    const SPELLDATA_KEY = 'key';
    const SPELLDATA_LEVEL_TIP = 'leveltip';
    const SPELLDATA_MAX_RANK = 'maxrank';
    const SPELLDATA_MODES = 'modes';
    const SPELLDATA_RANGE = 'range';
    const SPELLDATA_RANGE_BURN = 'rangeBurn';
    const SPELLDATA_RESOURCE = 'resource';
    const SPELLDATA_SANITIZED_DESCRIPTION = 'sanitizedDescription';
    const SPELLDATA_SANITIZED_TOOLTIP = 'sanitizedTooltip';
    const SPELLDATA_TOOLTIP = 'tooltip';
    const SPELLDATA_VARS = 'vars';

    /**
     *
     * @var array List[double] 
     */
    public $cooldown;

    /**
     *
     * @var string 
     */
    public $cooldownBurn;

    /**
     *
     * @var array List[int] 
     */
    public $cost;

    /**
     *
     * @var string 
     */
    public $costBurn;

    /**
     *
     * @var string 
     */
    public $costType;

    /**
     * 
     * @var string 
     */
    public $description;

    /**
     * This field is a List of List of Double.
     * @var array List[object] 
     */
    public $effect;

    /**
     *
     * @var array List[string] 
     */
    public $effectBurn;

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
     * @var string 
     */
    public $key;

    /**
     *
     * @var LevelTipDto 
     */
    public $leveltip;

    /**
     *
     * @var int 
     */
    public $maxrank;

    /**
     *
     * @var array List[string] 
     */
    public $modes;

    /**
     *
     * @var string 
     */
    public $name;

    /**
     * This field is either a List of Integer or the String 'self' for spells that target one's own champion.
     * @var mixed 
     */
    public $range;

    /**
     *
     * @var string 
     */
    public $rangeBurn;

    /**
     *
     * @var string
     */
    public $resource;

    /**
     *
     * @var string 
     */
    public $sanitizedDescription;

    /**
     *
     * @var string 
     */
    public $sanitizedTooltip;

    /**
     *
     * @var int 
     */
    public $summonerLevel;

    /**
     *
     * @var string 
     */
    public $tooltip;

    /**
     *
     * @var SpellVarsDto List[SpellVarsDto] 
     */
    public $vars;

    public function __construct($d) {
        $this->cooldown = $d->cooldown;
        $this->cooldownBurn = $d->cooldownBurn;
        $this->cost = $d->cost;
        $this->costBurn = $d->costBurn;
        $this->costType = $d->costType;
        $this->description = $d->description;
        $this->effect = $d->effect;
        $this->effectBurn = $d->effectBurn;
        $this->id = $d->id;
        $this->image = new ImageDto($d->image);
        $this->key = $d->key;
        $this->leveltip = new LevelTipDto($d->leveltip);
        $this->maxrank = $d->maxrank;
        $this->modes = $d->modes;
        $this->name = $d->name;
        $this->range = $d->range;
        $this->rangeBurn = $d->rangeBurn;
        $this->resource = $d->resource;
        $this->sanitizedDescription = $d->sanitizedDescription;
        $this->sanitizedTooltip = $d->sanitizedTooltip;
        $this->summonerLevel = $d->summonerLevel;
        $this->tooltip = $d->tooltip;
        $this->vars = [];
        foreach ($d->vars as $o) {
            $this->vars[] = new SpellVarsDto($o);
        }
    }

    /**
     * Recupera la image tag del summoner spell 1
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @return \LolApi\ImagesApi\ImageTag
     */
    public function getIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->summoner_spell($this->image->full, $imgTitle ? $imgTitle : $this->name, $imgClass, $v, $tooltip ? $tooltip : $this->description);
    }

}
