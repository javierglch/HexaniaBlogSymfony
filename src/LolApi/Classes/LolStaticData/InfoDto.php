<?php

namespace LolApi\Classes\LolStaticData;

/**
 * InfoDto
 * This object contains champion information.
 * @author Javier
 */
class InfoDto {
    
    /**
     * 
     * @var int
     */
    public $attack;
    
    /**
     * 
     * @var int
     */
    public $defense;
    /**
     * 
     * @var int
     */
    public $difficulty;
    /**
     * 
     * @var int
     */
    public $magic;
    
    function __construct($d) {
        $this->attack = $d->attack;
        $this->defense = $d->defense;
        $this->difficulty = $d->difficulty;
        $this->magic = $d->magic;
    }

}
