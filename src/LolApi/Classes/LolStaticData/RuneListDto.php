<?php

namespace LolApi\Classes\LolStaticData;

/**
 * RuneListDto
 * This object contains rune list data.
 * @author Javier
 */
class RuneListDto {

    #~ runeListData ~#
    const RUNELISTDATA_ALL = 'all';
    const RUNELISTDATA_BASIC = 'basic';
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
     * @var BasicDataDto
     */
    public $basic;

    /**
     * 
     * @var RuneDto Map[string, RuneDto]
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
        $this->basic = new BasicDataDto($d->basic);
        $this->data = [];
        foreach ($d->data as $key => $o) {
            $this->data[] = new RuneDto($o);
        }
        $this->type = $d->type;
        $this->version = $d->version;
    }

}
