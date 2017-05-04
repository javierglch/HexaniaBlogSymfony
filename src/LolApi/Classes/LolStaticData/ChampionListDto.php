<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ChampionListDto
 * This object contains champion list data.
 * @author Javier
 */
class ChampionListDto {

    // ~ champData in the request ~ 
    const CHAMPDATA_ALL = 'all';
    const CHAMPDATA_ALLYTIPS = 'allytips';
    const CHAMPDATA_ALTIMAGES = 'altimages';
    const CHAMPDATA_BLURB = 'blurb';
    const CHAMPDATA_ENEMYTIPS = 'enemytips';
    const CHAMPDATA_IMAGE = 'image';
    const CHAMPDATA_INFO = 'info';
    const CHAMPDATA_LORE = 'lore';
    const CHAMPDATA_PARTYPE = 'partype';
    const CHAMPDATA_PASSIVE = 'passive';
    const CHAMPDATA_RECOMMENDED = 'recommended';
    const CHAMPDATA_SKINS = 'skins';
    const CHAMPDATA_SPELLS = 'spells';
    const CHAMPDATA_STATS = 'stats';
    const CHAMPDATA_TAGS = 'tags';

    /**
     * Asociación de Key->ChampionInfo
     * @var ChampionDto array
     */
    public $data;

    /**
     * 
     * @var string
     */
    public $format;

    /**
     * Asociacion de key->championName
     * @var array [string,string]
     */
    public $keys;

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

    function __construct($d) {
        $this->data = [];
        foreach ($d->data as $key => $o) {
            $this->data[$key] = new ChampionDto($o);
        }
        $this->format = $d->format;
        $this->keys = $d->keys;
        $this->type = $d->type;
        $this->version = $d->version;
    }

}
