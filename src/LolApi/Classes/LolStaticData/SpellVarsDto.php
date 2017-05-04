<?php

namespace LolApi\Classes\LolStaticData;

/**
 * SpellVarsDto
 * This object contains spell vars data.
 * @author Javier
 */
class SpellVarsDto {

    /**
     * 
     * @var array of double
     */
    public $coeff;

    /**
     * 
     * @var string
     */
    public $dyn;

    /**
     * 
     * @var string
     */
    public $key;

    /**
     * 
     * @var string
     */
    public $link;

    /**
     * 
     * @var string
     */
    public $ranksWith;

    function __construct($d) {
        $this->coeff = $d->coeff;
        $this->dyn = $d->dyn;
        $this->key = $d->key;
        $this->link = $d->link;
        $this->ranksWith = $d->ranksWith;
    }

}
