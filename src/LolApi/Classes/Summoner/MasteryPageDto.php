<?php

namespace LolApi\Classes\Summoner;

/**
 * MasteryPageDto
 * This object contains mastery page information.
 * @author Javier
 */
class MasteryPageDto {

    /**
     * Indicates if the mastery page is the current mastery page.
     * @var boolean
     */
    public $current;
    
    /**
     * Mastery page ID.
     * @var long
     */
    public $id;
    
    /**
     * Collection of masteries associated with the mastery page.
     * @var MasteryDto array List[MasteryDto]
     */
    public $masteries;
    
    /**
     * Mastery page name.
     * @var string
     */
    public $name;
    

    public function __construct($d) {
        $this->current = $d->current;
        $this->id = $d->id;
        $this->masteries = $d->masteries;
        $this->name = $d->name;
    }

    
    
}
