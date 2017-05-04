<?php

namespace LolApi\Classes\TournamentProvider;

/**
 * TournamentCodeDTO
 *
 * @author Javier
 */
class TournamentCodeDTO {

    /**
     * 
     * @var string
     */
    public $code;

    /**
     * 
     * @var int
     */
    public $id;

    /**
     * 
     * @var string
     */
    public $lobbyName;

    /**
     * 
     * @var string
     */
    public $map;

    /**
     * 
     * @var string
     */
    public $metaData;

    /**
     * 
     * @var Set[long]
     */
    public $participants;

    /**
     * 
     * @var string
     */
    public $password;

    /**
     * 
     * @var string
     */
    public $pickType;

    /**
     * 
     * @var int
     */
    public $providerId;

    /**
     * 
     * @var string
     */
    public $region;

    /**
     * 
     * @var string
     */
    public $spectators;

    /**
     * 
     * @var int
     */
    public $teamSize;

    /**
     * 
     * @var int
     */
    public $tournamentId;

    function __construct($d) {
        foreach (get_object_vars($d) as $key => $value) {
            $this->$key = $value;
        }
    }

}
