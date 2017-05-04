<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MetaDataDto
 * 
 * @author Javier
 */
class MetaDataDto {
    
    /**
     *
     * @var boolean 
     */
    public $isRune;
    /**
     *
     * @var string 
     */
    public $tier;
    /**
     *
     * @var string 
     */
    public $type;
    
    function __construct($d) {
        $this->isRune = $d->isRune;
        $this->tier = $d->tier;
        $this->type = $d->type;
    }

}
