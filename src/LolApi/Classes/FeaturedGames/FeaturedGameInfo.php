<?php

/**
 * FeaturedGameInfo
 *
 * @author Javier
 */
class FeaturedGameInfo {
    # ~ gameMode ~ #

    const GAMEMODE_CLASSIC = 'CLASSIC';
    const GAMEMODE_ODIN = 'ODIN';
    const GAMEMODE_ARAM = 'ARAM';
    const GAMEMODE_TUTORIAL = 'TUTORIAL';
    const GAMEMODE_ONEFORALL = 'ONEFORALL';
    const GAMEMODE_ASCENSION = 'ASCENSION';
    const GAMEMODE_FIRSTBLOOD = 'FIRSTBLOOD';
    const GAMEMODE_KINGPORO = 'KINGPORO';

    # ~ gameType ~ #
    const GAMETYPE_CUSTOM_GAME = 'CUSTOM_GAME';
    const GAMETYPE_MATCHED_GAME = 'MATCHED_GAME';
    const GAMETYPE_TUTORIAL_GAME = 'TUTORIAL_GAME';

    /**
     * Banned champion information
     * @var BannedChampion array 
     */
    public $bannedChampions;

    /**
     * The ID of the game
     * @var long
     */
    public $gameId;

    /**
     * The amount of time in seconds that has passed since the game started
     * @var long
     */
    public $gameLength;

    /**
     * The game mode (Legal values: CLASSIC, ODIN, ARAM, TUTORIAL, ONEFORALL, ASCENSION, FIRSTBLOOD, KINGPORO)
     * @var string
     */
    public $gameMode;

    /**
     * The queue type (queue types are documented on the Game Constants page)
     * @var long
     */
    public $gameQueueConfigId;

    /**
     * The game start time represented in epoch milliseconds
     * @var long
     */
    public $gameStartTime;

    /**
     * The game type (Legal values: CUSTOM_GAME, MATCHED_GAME, TUTORIAL_GAME)
     * @var string
     */
    public $gameType;

    /**
     * The ID of the map
     * @var long
     */
    public $mapId;

    /**
     * The observer information
     * @var \LolApi\Classes\FeaturedGames\Observer
     */
    public $observers;

    /**
     * The participant information
     * @var LolApi\Classes\FeaturedGames\Participant array
     */
    public $participants;

    /**
     * The ID of the platform on which the game is being played
     * @var string
     */
    public $platformId;

    public function __construct($data) {
        $this->bannedChampions = [];
        foreach ($data->bannedChampions as $oBannedChampion) {
            $this->bannedChampions[] = new BannedChampion($oBannedChampion);
        }
        $this->gameId = $data->gameId;
        $this->gameLength = $data->gameLength;
        $this->gameMode = $data->gameMode;
        $this->gameQueueConfigId = $data->gameQueueConfigId;
        $this->gameStartTime = $data->gameStartTime;
        $this->gameType = $data->gameType;
        $this->mapId = $data->mapId;
        $this->observers = new Observer($data->observers);
        $this->participants = [];
        foreach ($data->participants as $oCurrentGameParticipant) {
            $this->participants[] = new CurrentGameParticipant($oCurrentGameParticipant);
        }
        $this->platformId = $data->platformId;
    }

    /** @var \LolApi\Classes\LolStaticData\MapDetailsDto */
    private $MapDetailsDto;
    
    /**
     * Recupera la información del mapa
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return MapDetailsDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMapDetailsDto($locale = null, $version = null) {
        $data = \LolApi\LolApi::globalApi()->getMapDataDto($locale, $version)->data;
        if(isset($data[$this->mapId])) {
            $this->MapDetailsDto = $data[$this->mapId];
        }
        return $this->MapDetailsDto;
    }

    /**
     * Devuelve el comando de consola para espectar el juego
     * @return string
     */
    public function getSpectateCMDCode(){
        $lolapi = \LolApi\LolApi::globalApi();
        $spectator = $lolapi->getSpectatorData($this->platformId);
        return '"C:/Riot Games/League of Legends/RADS/solutions/lol_game_client_sln/releases/'.$lolapi->getReleaseNumber().'/deploy/League of Legends.exe"'
        . ' "8394" "LoLLauncher.exe" "" "spectator '.$spectator['domain'].':'.$spectator['port'].' '.$this->observers->encryptionKey.' '.$this->gameId.' '.$this->platformId.'"';
    }
}
