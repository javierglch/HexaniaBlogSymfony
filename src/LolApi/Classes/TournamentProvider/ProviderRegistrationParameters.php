<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\Classes\TournamentProvider;

/**
 * ProviderRegistrationParameters
 *
 * @author Javier
 */
class ProviderRegistrationParameters {

    // ~ Region ~
    const REGION_BR = 'BR';
    const REGION_EUNE = 'EUNE';
    const REGION_EUW = 'EUW';
    const REGION_V = 'JP';
    const REGION_KR = 'KR';
    const REGION_LAN = 'LAN';
    const REGION_LAS = 'LAS';
    const REGION_NA = 'NA';
    const REGION_OCE = 'OCE';
    const REGION_PBE = 'PBE';
    const REGION_RU = 'RU';
    const REGION_TR = 'TR';

    /**
     * The region in which the provider will be running tournaments. (Legal values: BR, EUNE, EUW, JP, KR, LAN, LAS, NA, OCE, PBE, RU, TR)
     * @var string
     */
    public $region;

    /**
     * The provider's callback URL to which tournament game results in this region 
     * should be posted. The URL must be well-formed, use the http or https protocol, 
     * and use the default port for the protocol (http URLs must use port 80, 
     * https URLs must use port 443).
     * @var string 
     */
    public $url;

    function __construct($region, $url) {
        $this->region = $region;
        $this->url = $url;
    }

}
