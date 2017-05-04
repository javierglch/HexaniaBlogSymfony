<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\Classes\CurrentGame;

/**
 * Description of Observer
 *
 * @author Javier
 */
class Observer {
    
    /**
     * Key used to decrypt the spectator grid game data for playback
     * @var string 
     */
    public $encryptionKey;
    
    public function __construct($data) {
        $this->encryptionKey=$data->encryptionKey;
    }

}

