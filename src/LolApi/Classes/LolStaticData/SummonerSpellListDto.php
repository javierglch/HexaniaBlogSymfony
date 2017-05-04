<?php

namespace LolApi\Classes\LolStaticData;

/**
 * SummonerSpellListDto
 * This object contains summoner spell list data.
 * @author Javier
 */
class SummonerSpellListDto {
    #~ spellData ~#

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
     * @var SummonerSpellDto Map[string, SummonerSpellDto]
     */
    public $data;

    /**
     * 
     * @var string
     */
    public $type;

    /**
     * 
     * @var string
     */
    public $version;

    public function __construct($d) {
        $this->data = [];
        foreach ($d->data as $key => $o) {
            $this->data[$key] = new SummonerSpellDto($o);
        }
        $this->type = $d->type;
        $this->version = $d->version;
    }

}
