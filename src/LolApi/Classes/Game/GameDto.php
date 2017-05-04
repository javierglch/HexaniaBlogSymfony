<?php

namespace LolApi\Classes\Game;

/**
 * GameDto
 * This object contains game information.
 * @author Javier
 */
class GameDto {

    #~AMEMODE~#
    const GAMEMODE_CLASSIC = 'CLASSIC';
    const GAMEMODE_ODIN = 'ODIN';
    const GAMEMODE_ARAM = 'ARAM';
    const GAMEMODE_TUTORIAL = 'TUTORIAL';
    const GAMEMODE_ONEFORALL = 'ONEFORALL';
    const GAMEMODE_ASCENSION = 'ASCENSION';
    const GAMEMODE_FIRSTBLOOD = 'FIRSTBLOOD';
    const GAMEMODE_KINGPORO = 'KINGPORO';
    const GAMEMODE_SIEGE = 'SIEGE';
    #~GAMETYPE~#
    const GAMETYPE_CUSTOM_GAME = 'CUSTOM_GAME';
    const GAMETYPE_MATCHED_GAME = 'MATCHED_GAME';
    const GAMETYPE_TUTORIAL_GAME = 'TUTORIAL_GAME';
    #~SUBTYPE~#
    const SUBTYPE_NONE = 'NONE';
    const SUBTYPE_NORMAL = 'NORMAL';
    const SUBTYPE_BOT = 'BOT';
    const SUBTYPE_RANKED_SOLO_5x5 = 'RANKED_SOLO_5x5';
    const SUBTYPE_RANKED_PREMADE_3x3 = 'RANKED_PREMADE_3x3';
    const SUBTYPE_RANKED_PREMADE_5x5 = 'RANKED_PREMADE_5x5';
    const SUBTYPE_ODIN_UNRANKED = 'ODIN_UNRANKED';
    const SUBTYPE_RANKED_TEAM_3x3 = 'RANKED_TEAM_3x3';
    const SUBTYPE_RANKED_TEAM_5x5 = 'RANKED_TEAM_5x5';
    const SUBTYPE_NORMAL_3x3 = 'NORMAL_3x3';
    const SUBTYPE_BOT_3x3 = 'BOT_3x3';
    const SUBTYPE_CAP_5x5 = 'CAP_5x5';
    const SUBTYPE_ARAM_UNRANKED_5x5 = 'ARAM_UNRANKED_5x5';
    const SUBTYPE_ONEFORALL_5x5 = 'ONEFORALL_5x5';
    const SUBTYPE_FIRSTBLOOD_1x1 = 'FIRSTBLOOD_1x1';
    const SUBTYPE_FIRSTBLOOD_2x2 = 'FIRSTBLOOD_2x2';
    const SUBTYPE_SR_6x6 = 'SR_6x6';
    const SUBTYPE_URF = 'URF';
    const SUBTYPE_URF_BOT = 'URF_BOT';
    const SUBTYPE_NIGHTMARE_BOT = 'NIGHTMARE_BOT';
    const SUBTYPE_ASCENSION = 'ASCENSION';
    const SUBTYPE_HEXAKILL = 'HEXAKILL';
    const SUBTYPE_KING_PORO = 'KING_PORO';
    const SUBTYPE_COUNTER_PICK = 'COUNTER_PICK';
    const SUBTYPE_BILGEWATER = 'BILGEWATER';
    const SUBTYPE_SIEGE = 'SIEGE';
    const SUBTYPE_RANKED_FLEX_SR = 'RANKED_FLEX_SR';
    const SUBTYPE_RANKED_FLEX_TT = 'RANKED_FLEX_TT';

    /**
     * Champion ID associated with game.
     * @var int
     */
    public $championId;

    /**
     * Date that end game data was recorded, specified as epoch milliseconds.
     * @var long
     */
    public $createDate;

    /**
     * Other players associated with the game.
     * @var PlayerDto array
     */
    public $fellowPlayers;

    /**
     * Game ID.
     * @var long
     */
    public $gameId;

    /**
     * Game mode. (Legal values: CLASSIC, ODIN, ARAM, TUTORIAL, ONEFORALL, ASCENSION, FIRSTBLOOD, KINGPORO, SIEGE)
     * @var string
     */
    public $gameMode;

    /**
     * Game type. (Legal values: CUSTOM_GAME, MATCHED_GAME, TUTORIAL_GAME)
     * @var string
     */
    public $gameType;

    /**
     * Invalid flag.
     * @var boolean
     */
    public $invalid;

    /**
     * IP Earned.
     * @var int
     */
    public $ipEarned;

    /**
     * Level.
     * @var int
     */
    public $level;

    /**
     * Map ID.
     * @var int
     */
    public $mapId;

    /**
     * ID of first summoner spell.
     * @var int
     */
    public $spell1;

    /**
     * ID of second summoner spell.
     * @var int
     */
    public $spell2;

    /**
     * Statistics associated with the game for this summoner.
     * @var RawStatsDto
     */
    public $stats;

    /**
     * Game sub-type. (Legal values: NONE, NORMAL, BOT, RANKED_SOLO_5x5, 
     * RANKED_PREMADE_3x3, RANKED_PREMADE_5x5, ODIN_UNRANKED, RANKED_TEAM_3x3, 
     * RANKED_TEAM_5x5, NORMAL_3x3, BOT_3x3, CAP_5x5, ARAM_UNRANKED_5x5, 
     * ONEFORALL_5x5, FIRSTBLOOD_1x1, FIRSTBLOOD_2x2, SR_6x6, URF, URF_BOT, 
     * NIGHTMARE_BOT, ASCENSION, HEXAKILL, KING_PORO, COUNTER_PICK, BILGEWATER, 
     * SIEGE, RANKED_FLEX_SR, RANKED_FLEX_TT)
     * @var string
     */
    public $subType;

    /**
     * Team ID associated with game. Team ID 100 is blue team. Team ID 200 is purple team.
     * @var int
     */
    public $teamId;

    public function __construct($data) {
        $this->championId = $data->championId;
        $this->createDate = $data->createDate;
        $this->fellowPlayers = [];
        foreach ($data->fellowPlayers as $o) {
            $this->fellowPlayers[] = new PlayerDto($o);
        }
        $this->gameId = $data->gameId;
        $this->gameMode = $data->gameMode;
        $this->gameType = $data->gameType;
        $this->invalid = $data->invalid;
        $this->ipEarned = $data->ipEarned;
        $this->level = $data->level;
        $this->mapId = $data->mapId;
        $this->spell1 = $data->spell1;
        $this->spell2 = $data->spell2;
        $this->stats = new RawStatsDto($data->stats);
        $this->subType = $data->subType;
        $this->teamId = $data->teamId;
    }
    
    /** @var \LolApi\Classes\LolStaticData\ChampionDto */
    private $StaticChampionDto;

    /**
     * Recupera la información de un campeon
     * @param string $champData Usar LolStaticData\ChampionListDto::CHAMPDATA_... para escoger el tag. Tags to return additional data. Only type, version, data, id, key, name, and title are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return \LolApi\Classes\LolStaticData\ChampionDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getStaticChampionDto($champData = null, $locale = null, $version = null) {
        if (!$this->StaticChampionDto) {
            $this->StaticChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->championId, $champData, $locale, $version);
        }
        return $this->StaticChampionDto;
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
    
    /** @var \LolApi\Classes\LolStaticData\SummonerSpellDto */
    private $SummonerSpell_1;
    
    /**
     * Devuelve el hechizo de invocador buscado
     * @param string $spellData Usar SummonerSpellDto::SPELLDATA_... Tags to return additional data. Only id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param boolean $locale If specified as true, the returned data map will use the spells' IDs as the keys. If not specified or specified as false, the returned data map will use the spells' keys instead.
     * @param string $version Tags to return additional data. Only type, version, data, id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @return SummonerSpellDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerSpell_1($spellData=null, $locale=null, $version=null) {
        if (!$this->SummonerSpell_1) {
            $this->SummonerSpell_1 = \LolApi\LolApi::globalApi()->getSummonerSpellDto($this->spell1, $spellData, $locale, $version);
        }
        return $this->SummonerSpell_1;
    }
    
    /** @var \LolApi\Classes\LolStaticData\SummonerSpellDto */
    private $SummonerSpell_2;
    
    /**
     * Devuelve el hechizo de invocador buscado
     * @param string $spellData Usar SummonerSpellDto::SPELLDATA_... Tags to return additional data. Only id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param boolean $locale If specified as true, the returned data map will use the spells' IDs as the keys. If not specified or specified as false, the returned data map will use the spells' keys instead.
     * @param string $version Tags to return additional data. Only type, version, data, id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @return SummonerSpellDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerSpell_2($spellData=null, $locale=null, $version=null) {
        if (!$this->SummonerSpell_2) {
            $this->SummonerSpell_2 = \LolApi\LolApi::globalApi()->getSummonerSpellDto($this->spell2, $spellData, $locale, $version);
        }
        return $this->SummonerSpell_2;
    }

}
