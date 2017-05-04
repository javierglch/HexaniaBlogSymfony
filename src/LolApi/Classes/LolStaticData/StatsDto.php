<?php

namespace LolApi\Classes\LolStaticData;

/**
 * StatsDto
 * This object contains champion stats data.
 * @author Javier
 */
class StatsDto {

    /** @var double */
    public $armor;
    /** @var double */
    public $armorperlevel;
    /** @var double */
    public $attackdamage;
    /** @var double */
    public $attackdamageperlevel;
    /** @var double */
    public $attackrange;
    /** @var double */
    public $attackspeedoffset;
    /** @var double */
    public $attackspeedperlevel;
    /** @var double */
    public $crit;
    /** @var double */
    public $critperlevel;
    /** @var double */
    public $hp;
    /** @var double */
    public $hpperlevel;
    /** @var double */
    public $hpregen;
    /** @var double */
    public $hpregenperlevel;
    /** @var double */
    public $movespeed;
    /** @var double */
    public $mp;
    /** @var double */
    public $mpperlevel;
    /** @var double */
    public $mpregen;
    /** @var double */
    public $mpregenperlevel;
    /** @var double */
    public $spellblock;
    /** @var double */
    public $spellblockperlevel;

    function __construct($data) {
        foreach (get_object_vars($data) as $key => $value) {
            $this->$key = $value;
        }
    }

}
