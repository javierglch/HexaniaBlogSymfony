<?php

namespace LolApi\Classes\FeaturedGames;

/**
 * FeaturedGames
 *
 * @author Javier
 */
class FeaturedGames {

    /**
     * The suggested interval to wait before requesting FeaturedGames again
     * @var long
     */
    public $clientRefreshInterval;

    /**
     * The list of featured games
     * @var FeaturedGameInfo array
     */
    public $gameList;

    public function __construct($data) {
        $this->clientRefreshInterval = $data->clientRefreshInterval;
        $this->gameList = [];
        foreach ($data->gameList as $o) {
            $this->gameList[] = new FeaturedGameInfo($o);
        }
    }

}
