<?php

namespace LolApi\Classes\LolStaticData;

/**
 * GroupDto
 * This object contains item group data.
 * @author Javier
 */
class GroupDto {
    /**
     * 
     * @var string
     */
    public $MaxGroupOwnable;
    /**
     * 
     * @var string
     */
    public $key;
    
    function __construct($d) {
        $this->MaxGroupOwnable = $d->MaxGroupOwnable;
        $this->key = $d->key;
    }

    
}
