<?php

namespace LolApi\Classes\LolStaticData;

/**
 * LevelTipDto
 * This object contains champion level tip data.
 * @author Javier
 */
class LevelTipDto {

    /**
     *
     * @var array string
     */
    public $effect;

    /**
     *
     * @var array string
     */
    public $label;

    function __construct($d) {
        $this->effect = $d->effect;
        $this->label = $d->label;
    }

}
