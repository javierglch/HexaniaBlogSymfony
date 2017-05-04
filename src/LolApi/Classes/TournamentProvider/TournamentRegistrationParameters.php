<?php

namespace LolApi\Classes\TournamentProvider;

/**
 * Description of TournamentRegistrationParameters
 *
 * @author Javier
 */
class TournamentRegistrationParameters {
    
    /**
     * The optional name of the tournament.
     * @var string  
     */
    public $name;
    /**
     * The provider ID to specify the regional registered provider data to associate this tournament.
     * @var int 
     */
    public $providerId;
    
    function __construct($name, $providerId) {
        $this->name = $name;
        $this->providerId = $providerId;
    }

}
