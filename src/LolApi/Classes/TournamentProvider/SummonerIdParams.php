<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\Classes\TournamentProvider;

/**
 * Description of SummonerIdParams
 *
 * @author Javier
 */
class SummonerIdParams {
    
    
    /**
     *the tournament participants
     * @var Set[long] 
     */
    public $participants;
    
    function __construct(array $participants) {
        $this->participants = $participants;
    }

}
