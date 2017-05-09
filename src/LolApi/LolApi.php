<?php

namespace LolApi;

use LolApi\Cache\CacheManager;
use LolApi\ImagesApi\ImagesApi;
use LolApi\Classes\Champion\ChampionDto;
use LolApi\Classes\Champion\ChampionListDto;
use LolApi\Classes\ChampionMastery\ChampionMasteryDTO;
use LolApi\Classes\CurrentGame\CurrentGameInfo;
use LolApi\Classes\FeaturedGames\FeaturedGames;
use LolApi\Classes\Game\RecentGamesDto;
use LolApi\Classes\League\LeagueDto;
use LolApi\Classes\LolStaticData\ChampionListDto as StaticChampionListDto;
use LolApi\Classes\LolStaticData\ChampionDto as StaticChampionDto;
use LolApi\Classes\LolStaticData\ItemListDto;
use LolApi\Classes\LolStaticData\ItemDto;
use LolApi\Classes\LolStaticData\LanguageStringsDto;
use LolApi\Classes\LolStaticData\MapDataDto;
use LolApi\Classes\LolStaticData\MasteryListDto;
use LolApi\Classes\LolStaticData\MasteryDto;
use LolApi\Classes\LolStaticData\RealmDto;
use LolApi\Classes\LolStaticData\RuneListDto;
use LolApi\Classes\LolStaticData\RuneDto;
use LolApi\Classes\LolStaticData\SummonerSpellListDto;
use LolApi\Classes\LolStaticData\SummonerSpellDto;
use LolApi\Classes\LolStatus\Shard;
use LolApi\Classes\LolStatus\ShardStatus;
use LolApi\Classes\Match\MatchDetail;
use LolApi\Classes\MatchList\MatchList;
use LolApi\Classes\Stats\RankedStatsDto;
use LolApi\Classes\Summoner\SummonerDto;
use LolApi\Classes\Summoner\MasteryPagesDto;
use LolApi\Classes\Summoner\RunePagesDto;
use LolApi\Classes\TournamentProvider\TournamentCodeParameters;
use LolApi\Classes\TournamentProvider\TournamentCodeDTO;
use LolApi\Classes\TournamentProvider\LobbyEventDTOWrapper;
use LolApi\Classes\TournamentProvider\ProviderRegistrationParameters;
use LolApi\Classes\TournamentProvider\TournamentRegistrationParameters;

class LolApi {
    // <editor-fold defaultstate="collapsed" desc="# ~ GLOBAL API, VARIABLES Y CONSTRUCTOR ~ #">

    /**
     * almacena LolApi para ser utilizada de manera más globalizada y atacar a 
     * siempre a la misma sin necesidad de crear el objeto constantemente.
     * Se utiliza sobretodo cuando se va a usar fuera del framework.
     * @var LolApi 
     */
    private static $global_api = null;

    /**
     * Recupera el objeto LolApi global, para tirar siempre del mismo objeto sin 
     * necesidad de estar creandolo constantemente.
     * @return LolApi
     */
    public static function globalApi() {
        if (self::$global_api == null) {
            self::$global_api = new LolApi();
        }
        return self::$global_api;
    }

    /** @var LolApiConfig */
    public $LolApiConfig;

    /** @var RequestManager */
    public $RequestManager;

    /** @var ImagesApi */
    public $ImagesApi;

    /**
     * Construye LolApi
     * @param string $apiKeyDev KEY para la api en desarrollo Si necesitas cambiar la clave de produccion ir a LolApiConfig
     */
    function __construct($apiKeyDev = null) {
        $this->LolApiConfig = new LolApiConfig();
        $this->RequestManager = new RequestManager();
        if ($apiKeyDev !== null) {
            $this->LolApiConfig->api_key_development = $apiKeyDev;
        }
        $this->ImagesApi = new ImagesApi();
        self::$global_api = $this;
    }

    //</editor-fold>
    // <editor-fold defaultstate="collapsed" desc="# ~ METODOS PRIVADOS ~ #">

    /**
     * Construye los parametros por defecto más utilzados: api_key, {region}, locale
     * @return array
     */
    private function defaultParams() {
        return [
            "api_key" => $this->LolApiConfig->api_key_development, //cambiar segun environment
            "{region}" => $this->LolApiConfig->region,
            "{platformId}" => strtolower($this->LolApiConfig->getPlatformId($this->LolApiConfig->region))
        ];
    }

    /**
     * Recupera los datos desde con ayuda del RequestManager, que tiene en cuenta tanto la cache como la url
     * @param string $resourceUrl url sin parametros, sacada de dal clase URLs
     * @param array $aParams parametros para la url
     * @param string $function funcion utilizada para indexar la cache
     * @param int $maxTimeElapsed maximo tiempo de uso de la cache estatica
     * @param string $method tipo de peticion. Usar RequestManager::METHOD_...
     * @return mixed stdClass o Array dependiendo del resultado de la api. Lo devuelve
     * descomprimiendolo del formato json
     */
    private function doRequest($resourceUrl, $aParams, $function, $maxTimeElapsed, $method = RequestManager::METHOD_GET) {
        $data = $this->RequestManager->doRequest($resourceUrl, $aParams, $function, $maxTimeElapsed, $this->LolApiConfig, $method);
        return json_decode($data);
    }

    // </editor-fold>
    //<editor-fold defaultstate="collapsed" desc="# ~ PETICIONES A LolApiConfig ~ #">

    /**
     * Devuelve el numero de Game Client Release number en la que se ubica el cliente en las carpetas de windows
     * @return int Release number
     */
    public function getReleaseNumber() {
        return $this->LolApiConfig->getGameClientReleaseNumber();
    }

    /**
     * Modifica la variable Game Client Release
     */
    public function updateReleaseNumber() {
        $this->LolApiConfig->setGameClientReleaseNumber();
    }

    /**
     * Devuelve los datos de dominio y puerto para espectar una partida, buscados por la $platformId
     * Para recueprar la $platformId hay que utilizar LolApiConfig->getPlatformId($region)
     * @param string $platformId
     * @return array [string,string] or null
     * El array devuelto posee dos claves: 'domain' y 'port'
     */
    public function getSpectatorData($platformId) {
        return $this->LolApiConfig->getSpectatorData($platformId);
    }

    //</editor-fold>
    // <editor-fold defaultstate="collapsed" desc="# ~ PETICIONES A RIOT API ~ #">
    # ~ PETICIONES DE API ~ #

    /**
     * 
     * @param boolean $boolFreeToPlay Optional filter param to retrieve only free to play champions.
     * @return ChampionListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     * @deprecated 24/07/2017 use getChampionListDtoV3
     */
    public function getChampionListDto($boolFreeToPlay = null) {
        $aParams = $this->defaultParams();
        if ($boolFreeToPlay !== null) {
            $aParams["freeToPlay"] = $boolFreeToPlay ? 'true' : 'false';
        }
        $data = $this->doRequest(URLs::R_URL_CHAMPION, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new ChampionListDto($data);
    }
    
    /**
     * 
     * @param boolean $boolFreeToPlay Optional filter param to retrieve only free to play champions.
     * @return ChampionListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getChampionListDtoV3($boolFreeToPlay = null) {
        $aParams = $this->defaultParams();
        if ($boolFreeToPlay !== null) {
            $aParams["freeToPlay"] = $boolFreeToPlay ? 'true' : 'false';
        }
        $data = $this->doRequest(URLs::R_URL_CHAMPION_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new ChampionListDto($data);
    }

    /**
     * 
     * @param int $id ID of the champion to retrieve.
     * @return ChampionDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     * @deprecated 24/07/2017 use getChampionDtoV3
     */
    public function getChampionDto($id) {
        $aParams = $this->defaultParams();
        $aParams["{id}"] = $id;
        $data = $this->doRequest(URLs::R_URL_CHAMPION_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new ChampionDto($data);
    }
    
    /**
     * 
     * @param int $id ID of the champion to retrieve.
     * @return ChampionDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getChampionDtoV3($id) {
        $aParams = $this->defaultParams();
        $aParams["{id}"] = $id;
        $data = $this->doRequest(URLs::R_URL_CHAMPION_ID_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new ChampionDto($data);
    }

    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param long $playerId Summoner ID associated with the player
     * @param long $championId Champion ID to retrieve Champion Mastery for
     * @return ChampionMasteryDTO
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     * @deprecated 24/07/2017 use getChampionMasteryDTOV3
     */
    public function getChampionMasteryDTO($playerId, $championId) {
        $aParams = $this->defaultParams();
        $aParams['{playerId}'] = $playerId;
        $aParams['{championId}'] = $championId;
        $data = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_CHAMP_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new ChampionMasteryDTO($data);
    }
    
    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param long $summonerId Summoner ID associated with the player
     * @param long $championId Champion ID to retrieve Champion Mastery for
     * @return ChampionMasteryDTO
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     */
    public function getChampionMasteryDTOV3($summonerId, $championId) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        $aParams['{championId}'] = $championId;
        $data = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_CHAMP_ID_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new ChampionMasteryDTO($data);
    }

    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param long $playerId Summoner ID associated with the player
     * @return ChampionMasteryDTO array
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     * @deprecated 24/07/2017 use getChampionMasteryDTOListV3
     */
    public function getChampionMasteryDTOList($playerId) {
        $aParams = $this->defaultParams();
        $aParams['{playerId}'] = $playerId;
        $datas = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_LIST, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $data) {
            $aResult[] = new ChampionMasteryDTO($data);
        }
        return $aResult;
    }
    
    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param long $summonerid Summoner ID associated with the player
     * @return ChampionMasteryDTO array
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     */
    public function getChampionMasteryDTOListV3($summonerid) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerid;
        $datas = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_LIST_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $data) {
            $aResult[] = new ChampionMasteryDTO($data);
        }
        return $aResult;
    }

    /**
     * Get Total score of Champion Mastery
     * @param long $playerId
     * @return int
     * @deprecated 24/07/2017 use getChampionMasteryScoreV3
     */
    public function getChampionMasteryScore($playerId) {
        $aParams = $this->defaultParams();
        $aParams['{playerId}'] = $playerId;
        $data = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_SCORE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return $data;
    }
    
    /**
     * Get Total score of Champion Mastery
     * @param long $summonerId Summoner ID associated with the player
     * @return int
     */
    public function getChampionMasteryScoreV3($summonerId) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        $data = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_SCORE_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return $data;
    }

    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param long $playerId Summoner ID associated with the player
     * @param int $count Number of entries to retrieve, defaults to 3
     * @return ChampionMasteryDTO array
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     */
    public function getChampionMasteryTopChampions($playerId, $count = null) {
        $aParams = $this->defaultParams();
        $aParams['{playerId}'] = $playerId;
        $aParams['count'] = $count ? $count : 3;
        $datas = $this->doRequest(URLs::R_URL_CHAMPION_MASTERY_TOP, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $data) {
            $aResult[] = new ChampionMasteryDTO($data);
        }
        return $aResult;
    }

    /**
     * Recupera el current game
     * @param long $summonerId The ID of the summoner.
     * @return CurrentGameInfo
     * @throws Exceptions\ForbiddenException
     * @throws Exceptions\RateLimitExceededException
     * @deprecated 24/07/2017 use getCurrentGameInfoV3
     */
    public function getCurrentGameInfo($summonerId) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        $data = $this->doRequest(URLs::R_URL_CURRENT_GAME, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A);
        return new CurrentGameInfo($data);
    }
    
    /**
     * Get current game information for the given summoner ID.
     * @param long $summonerId The ID of the summoner.
     * @return CurrentGameInfo
     * @throws Exceptions\ForbiddenException
     * @throws Exceptions\RateLimitExceededException
     */
    public function getCurrentGameInfoV3($summonerId) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        $data = $this->doRequest(URLs::R_URL_CURRENT_GAME_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A);
        return new CurrentGameInfo($data);
    }

    /**
     * Recupera los featured games
     * @return Classes\FeaturedGames\FeaturedGames
     * @throws Exceptions\ForbiddenException
     * @throws Exceptions\RateLimitExceededException
     * @deprecated 24/07/2017 use getCurrentGameInfoV3
     */
    public function getFeaturedGames() {
        $aParams = $this->defaultParams();
        $data = $this->doRequest(URLs::R_URL_FEATURED_GAMES, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A2);
        return new FeaturedGames($data);
    }

    /**
     * Recupera los featured games
     * @return Classes\FeaturedGames\FeaturedGames
     * @throws Exceptions\ForbiddenException
     * @throws Exceptions\RateLimitExceededException
     */
    public function getFeaturedGamesV3() {
        $aParams = $this->defaultParams();
        $data = $this->doRequest(URLs::R_URL_FEATURED_GAMES_v3, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A2);
        return new FeaturedGames($data);
    }

    /**
     * Recupera las ultimas 10 partidas del invocador
     * @param long $summonerId ID of the summoner for which to retrieve recent games.
     * @return RecentGamesDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     * @deprecated 24/07/2017 use getRecentGamesDtoV3
     */
    public function getRecentGamesDto($summonerId) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        $data = $this->doRequest(URLs::R_URL_RECENT_GAMES, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new RecentGamesDto($data);
    }

    /**
     * Recupera las ligas en las que se encuentran los invocadores dados
     * @param array $summonerIds se transforma posteriormente en una lista separada por comas.
     * @return LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLeagueDtoList(array $summonerIds) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = implode(',', $summonerIds);
        $datas = $this->doRequest(URLs::R_URL_LEAGUES_BY_SUMMONERS, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $summonerId => $aLeagueDtos) {
            foreach ($aLeagueDtos as $oLeagueDto) {
                $aResult[$summonerId] = new LeagueDto($oLeagueDto);
            }
        }
        return $aResult;
    }

    /**
     * Recupera las entradas de los invocadores en las ligas en las que se encuentran
     * @param array $summonerIds se transforma posteriormente en una lista separada por comas.
     * @return LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLeagueDtoListEnry(array $summonerIds) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = implode(',', $summonerIds);
        $datas = $this->doRequest(URLs::R_URL_LEAGUES_BY_SUMMONERS_ENTRY, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $summonerId => $aLeagueDtos) {
            foreach ($aLeagueDtos as $oLeagueDto) {
                $aResult[$summonerId] = new LeagueDto($oLeagueDto);
            }
        }
        return $aResult;
    }

    /**
     * Recupera la liga challenger del tipo de liga pasada
     * @param string $type Game queue type. Escoger de LeagueDto:QUEUE_... <BR> RANKED_FLEX_SR, RANKED_FLEX_TT, RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5
     * @return LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLeagueDtoChallenger($type) {
        $aParams = $this->defaultParams();
        $aParams['type'] = $type;
        $datas = $this->doRequest(URLs::R_URL_LEAGUE_CHALLENGER, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $summonerId => $oLeagueDto) {
            $aResult[$summonerId] = new LeagueDto($oLeagueDto);
        }
        return $aResult;
    }

    /**
     * Recupera la liga master del tipo de liga pasada
     * @param string $type Game queue type. Escoger de LeagueDto:QUEUE_... <BR> RANKED_FLEX_SR, RANKED_FLEX_TT, RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5
     * @return LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLeagueDtoMaster($type) {
        $aParams = $this->defaultParams();
        $aParams['type'] = $type;
        $datas = $this->doRequest(URLs::R_URL_LEAGUE_CHALLENGER, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $summonerId => $oLeagueDto) {
            $aResult[$summonerId] = new LeagueDto($oLeagueDto);
        }
        return $aResult;
    }

    /**
     * Recupera la lista de los campeones con toda la información que se necesite sobre ellos
     * @param string $champData Usar ChampionListDto::CHAMPDATA_... para escoger el tag. Tags to return additional data. Only type, version, data, id, key, name, and title are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param boolean $dataById If specified as true, the returned data map will use the champions' IDs as the keys. If not specified or specified as false, the returned data map will use the champions' keys instead.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getStaticChampionListDto($champData = null, $dataById = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        if ($champData) {
            $aParams['champData'] = $champData;
        }
        if ($dataById !== null) {
            $aParams['dataById'] = $dataById ? 'true' : 'false';
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_CHAMPION, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new StaticChampionListDto($data);
    }

    /**
     * Recupera la información de un campeon
     * @param int $id Champion ID
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
    public function getStaticChampionDto($id, $champData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        $aParams['{id}'] = $id;
        if ($champData) {
            $aParams['champData'] = $champData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_CHAMPION_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new StaticChampionDto($data);
    }

    /**
     * 
     * @param string $itemListData Use ItemListDto::ITEMLISTDATA_... Tags to return additional data. Only type, version, basic, data, id, name, plaintext, group, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return ItemListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getStaticItemListDto($itemListData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        if ($itemListData) {
            $aParams['itemListData'] = $itemListData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_ITEM, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new ItemListDto($data);
    }

    /**
     * 
     * @param int $id Item ID
     * @param string $itemData Use ItemDto::ITEMDATA_... Tags to return additional data. Only id, name, plaintext, group, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return ItemDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getStaticItemDto($id, $itemData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        if ($itemData) {
            $aParams['itemData'] = $itemData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_ITEM_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new ItemDto($data);
    }

    /**
     * Realiza las traducciones de diferentes variables al lenguaje "locale" proporcionado
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return LanguageStringsDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLanguageStringsDto($locale = null, $version = null) {
        $aParams = $this->defaultParams();
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_LANGUAGE_STRINGS, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new LanguageStringsDto($data);
    }

    /**
     * Recupera en un listado los lenguajes o "locales" disponibles: es_ES, en_US, de_DE...
     * @return array List[string]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLanguagesList() {
        $aParams = $this->defaultParams();
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_LANGUAGE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return $data;
    }

    /**
     * Recupera la información de los mapas
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return MapDataDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMapDataDto($locale = null, $version = null) {
        $aParams = $this->defaultParams();
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_MAPS, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new MapDataDto($data);
    }

    /**
     * Devuelve el listado de las runas y su información
     * @param string $masteryListData Usar MasteryDto::MASTERYLISTDATA_... Tags to return additional data. Only type, version, data, id, name, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return MasteryListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMasteryListDto($masteryListData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        if ($masteryListData) {
            $aParams['masteryListData'] = $masteryListData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_MASTERY, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new MasteryListDto($data);
    }

    /**
     * Devuelve la información de la runa buscada
     * @param string $id Mastery ID
     * @param string $masteryData Usar MasteryDto::MASTERYDATA_... Tags to return additional data. Only type, version, data, id, name, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return MasteryDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMasteryDto($id, $masteryData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        $aParams['{id}'] = $id;
        if ($masteryData) {
            $aParams['masteryData'] = $masteryData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_MASTERY_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new MasteryDto($data);
    }

    /**
     * Recupera el realm de riot
     * @return RealmDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRealmDto() {
        $aParams = $this->defaultParams();
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_REALM, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_C);
        return new RealmDto($data);
    }

    /**
     * Devuelve el listado de las runas y su información
     * @param string $runeListData Usar RuneListDto::RUNELISTDATA_... Tags to return additional data. Only type, version, data, id, name, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return RuneListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRuneListDto($runeListData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        if ($runeListData) {
            $aParams['runeListData'] = $runeListData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_RUNE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new RuneListDto($data);
    }

    /**
     * Devuelve la información de la runa buscada
     * @param string $id Rune ID
     * @param string $masteryData Usar MasteryDto::MASTERYDATA_... Tags to return additional data. Only type, version, data, id, name, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return RuneDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRuneDto($id, $masteryData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        $aParams['{id}'] = $id;
        if ($masteryData) {
            $aParams['masteryData'] = $masteryData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_RUNE_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new RuneDto($data);
    }

    /**
     * Devuelve los hechizos de invocador y su información
     * @param string $spellData Usar SummonerSpellListDto::SPELLDATA_... Tags to return additional data. Only id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $dataById Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @param boolean $locale If specified as true, the returned data map will use the spells' IDs as the keys. If not specified or specified as false, the returned data map will use the spells' keys instead.
     * @param string $version Tags to return additional data. Only type, version, data, id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @return SummonerSpellListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerSpellListDto($spellData = null, $dataById = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        if ($spellData) {
            $aParams['spellData'] = $spellData;
        }
        if ($dataById !== null) {
            $aParams['dataById'] = $dataById ? 'true' : 'false';
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_SUMMONER_SPELL, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new SummonerSpellListDto($data);
    }

    /**
     * Devuelve el hechizo de invocador buscado
     * @param int $id Summoner spell ID
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
    public function getSummonerSpellDto($id, $spellData = null, $locale = null, $version = null) {
        $aParams = $this->defaultParams();
        $aParams['{id}'] = $id;
        if ($spellData) {
            $aParams['spellData'] = $spellData;
        }
        $aParams['locale'] = $locale ? $locale : $this->LolApiConfig->default_locale;
        if ($version) {
            $aParams['version'] = $version;
        }
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_SUMMONER_SPELL_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new SummonerSpellDto($data);
    }

    /**
     * Devuelve el listado de versiones de la API
     * @return array List[string]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getVersions() {
        $aParams = $this->defaultParams();
        $data = $this->doRequest(URLs::R_URL_STATIC_DATA_VERSIONS, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return $data;
    }

    /**
     * Devuelve el listado de shards
     * @return array List[string]
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\ForbiddenException
     */
    public function getShards() {
        $datas = $this->doRequest(URLs::R_URL_STATUS_SHARDS, [], __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        $aResult = [];
        foreach ($datas as $o) {
            $aResult[] = new Shard($o);
        }
        return $datas;
    }

    /**
     * 
     * @param string $shard Usar ShardStatus::SHARD_... The region for which to fetch data.
     * @return ShardStatus
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\ForbiddenException
     */
    public function getShardStatus($shard) {
        $aParams = $this->defaultParams();
        $aParams['{shard}'] = $shard;
        $data = $this->doRequest(URLs::R_URL_STATUS_SHARDS_SHARD, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new ShardStatus($data);
    }

    /**
     * Recupera el detalle de una partida segun su matchId (normalmente solo es para partidas ranked)
     * @param long $matchId
     * @param boolean $includeTimeline
     * @return MatchDetail
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMatchDetail($matchId, $includeTimeline = null) {
        $aParams = $this->defaultParams();
        $aParams['{matchId}'] = $matchId;
        if ($includeTimeline !== null) {
            $aParams['includeTimeline'] = $includeTimeline ? 'true' : 'false';
        }
        $data = $this->doRequest(URLs::R_URL_MATCH, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_D);
        return new MatchDetail($data);
    }

    /**
     * Recupera las partidas ranked del invocador dado<br>
     * +Info: A number of optional parameters are provided for filtering. It is up to the caller to ensure that the combination of filter parameters provided is valid for the requested summoner, otherwise, no matches may be returned. If either of the beginTime or endTime parameters is set, they must both be set, although there is no maximum limit on their range. If the beginTime parameter is specified on its own, endTime is assumed to be the current time. If the endTime parameter is specified on its own, beginTime is assumed to be the start of the summoner's match history.
     * @param long $summonerId The ID of the summoner.
     * @param int $beginIndex The begin index to use for fetching games.
     * @param int $endIndex The end index to use for fetching games.
     * @param string $beginTime The begin time to use for fetching games specified as epoch milliseconds.
     * @param string $endTime The end time to use for fetching games specified as epoch milliseconds.
     * @param array $championIds List of champion IDs to use for fetching games.
     * @param array $rankedQueues Usar MatchList::RANKEDQUEUE_... List of ranked queue types to use for fetching games. Non-ranked queue types will be ignored.
     * @param array $seasons Usar MatchList::SEASON_... List of seasons to use for fetching games.
     * @return \LolApi\MatchList
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMatchList($summonerId, $beginIndex = null, $endIndex = null, $beginTime = null, $endTime = null, $championIds = null, $rankedQueues = null, $seasons = null) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        if ($championIds !== null) {
            $aParams['championIds'] = implode(',', $championIds);
        }
        if ($rankedQueues !== null) {
            $aParams['rankedQueues'] = implode(',', $rankedQueues);
        }
        if ($seasons !== null) {
            $aParams['seasons'] = implode(',', $seasons);
        }
        if ($beginTime !== null) {
            $aParams['beginTime'] = $beginTime;
        }
        if ($endTime !== null) {
            $aParams['endTime'] = $endTime;
        }
        if ($beginIndex !== null) {
            $aParams['beginIndex'] = $beginIndex;
        }
        if ($endIndex !== null) {
            $aParams['endIndex'] = $endIndex;
        }
        $data = $this->doRequest(URLs::R_URL_MATCHLIST, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new MatchList($data);
    }

    /**
     * Develve las estadisticas ranked
     * Includes ranked stats for Twisted Treeline and Summoner's Rift.
     * @param long $summonerId ID of the summoner for which to retrieve ranked stats.
     * @param string $season Usar RankedStatsDto::SEASON_... If specified, stats for the given season are returned. Otherwise, stats for the current season are returned.
     * @return RankedStatsDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRankedStatsDto($summonerId, $season = null) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        if ($season !== null) {
            $aParams['season'] = $season;
        }
        $data = $this->doRequest(URLs::R_URL_STATS_RANKED, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new RankedStatsDto($data);
    }

    /**
     * Develve las estadisticas ranked
     * One summary is returned per queue type.
     * @param long $summonerId ID of the summoner for which to retrieve ranked stats.
     * @param string $season Usar PlayerStatsSummaryListDto::SEASON_... If specified, stats for the given season are returned. Otherwise, stats for the current season are returned.
     * @return PlayerStatsSummaryListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getPlayerStatsSummaryListDto($summonerId, $season = null) {
        $aParams = $this->defaultParams();
        $aParams['{summonerId}'] = $summonerId;
        if ($season !== null) {
            $aParams['season'] = $season;
        }
        $data = $this->doRequest(URLs::R_URL_STATS_SUMMARY, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new RankedStatsDto($data);
    }

    /**
     * Devuelve los invocadores buscandolos por nombre
     * @param array $summonerNames Comma-separated list of summoner names or standardized summoner names associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return SummonerDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDtoByNames(array $summonerNames) {
        $aParams = $this->defaultParams();
        $aParams['{summonerNames}'] = implode(',', $summonerNames);
        $datas = $this->doRequest(URLs::R_URL_SUMMONER_BY_NAME, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $key => $o) {
            $aResult[$key] = new SummonerDto($o);
        }
        return $aResult;
    }

    /**
     * Devuelve los invocadores buscandolos por nombre
     * @param array $summonerName Comma-separated list of summoner names or standardized summoner names associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return SummonerDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDtoByName($summonerName) {
        $aParams = $this->defaultParams();
        $aParams['{summonerNames}'] = $summonerName;
        $datas = $this->doRequest(URLs::R_URL_SUMMONER_BY_NAME, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $keyAttr = array_keys(get_object_vars($datas))[0];
        return new SummonerDto($datas->$keyAttr);
    }

    /**
     * Devuelve los invocadodres buscandolos por id
     * @param array $summonerIds Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return SummonerDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDtoByIds(array $summonerIds) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = implode(',', $summonerIds);
        $datas = $this->doRequest(URLs::R_URL_SUMMONER_BY_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $key => $o) {
            $aResult[$key] = new SummonerDto($o);
        }
        return $aResult;
    }

    /**
     * Devuelve los invocadodres buscandolos por id
     * @param long $summonerId summoner ID associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return SummonerDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDtoById($summonerId) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = $summonerId;
        $datas = $this->doRequest(URLs::R_URL_SUMMONER_BY_ID, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $keyAttr = array_keys(get_object_vars($datas))[0];
        return new SummonerDto($datas->$keyAttr);
    }

    /**
     * Devuelve las páginas de maestrias de los invocadores buscandos
     * @param array $summonerIds Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return MasteryPagesDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMasteryPagesDto(array $summonerIds) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = implode(',', $summonerIds);
        $datas = $this->doRequest(URLs::R_URL_SUMMONER_MASTERIES, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $key => $o) {
            $aResult[$key] = new MasteryPagesDto($o);
        }
        return $aResult;
    }

    /**
     * Devuelve las páginas de maestrias de los invocadores buscandos
     * @param array $summonerIds Comma-separated list of summoner IDs associated with summoners to retrieve. Maximum allowed at once is 40.
     * @return RunePagesDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRunePagesDto(array $summonerIds) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = implode(',', $summonerIds);
        $datas = $this->doRequest(URLs::R_URL_SUMMONER_RUNES, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        $aResult = [];
        foreach ($datas as $key => $o) {
            $aResult[$key] = new RunePagesDto($o);
        }
        return $aResult;
    }

    /**
     * Devuelve los nombres de invocador buscados por el id
     * @param array Map[string, string]
     * @return SummonerDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerNamesByIds(array $summonerIds) {
        $aParams = $this->defaultParams();
        $aParams['{summonerIds}'] = implode(',', $summonerIds);
        $data = $this->doRequest(URLs::R_URL_SUMMONER_NAME, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_C);
        return $data;
    }

    # ~ TOURNAMENT ~ #

    /**
     * Create a tournament code for the given tournament. (REST
     * @param int $tournamentId The tournament ID
     * @param int $count The number of codes to create (max 1000)
     * @return TournamentCodeParameters
     */
    public function postTournamentPublicCode($tournamentId, $count = 1) {
        $aParams = $this->defaultParams();
        $aParams['tournamentId'] = $tournamentId;
        if ($count) {
            $aParams['count'] = $count;
        }
        $datas = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_CODE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A, RequestManager::METHOD_POST);
        $aResult = [];
        foreach ($datas as $key => $data) {
            $aResult[$key] = new TournamentCodeParameters($data);
        }

        return $aResult;
    }

    /**
     * Returns the tournament code DTO associated with a tournament code string. (REST)
     * @param string $tournamentCode
     * @return TournamentCodeDTO
     */
    public function getTournamentPublicCode($tournamentCode) {
        $aParams = $this->defaultParams();
        $aParams['{tournamentCode}'] = $tournamentCode;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_CODE_TOURNAMENTCODE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A, RequestManager::METHOD_GET);
        return new TournamentCodeDTO($data);
    }

    /**
     * Update the pick type, map, spectator type, or allowed summoners for a code (REST)
     * @param string $tournamentCode The tournament code to update
     * @return TournamentCodeDTO
     */
    public function putTournamentPublicCode($tournamentCode) {
        $aParams = $this->defaultParams();
        $aParams['{tournamentCode}'] = $tournamentCode;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_CODE_TOURNAMENTCODE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A, RequestManager::METHOD_PUT);
        return new TournamentCodeDTO($data);
    }

    /**
     * Gets a list of lobby events by tournament code (REST)
     * @param string $tournamentCode The short code to look up lobby events for
     * @return LobbyEventDTOWrapper
     */
    public function getTournamentPublicLobbyEventsByCode($tournamentCode) {
        $aParams = $this->defaultParams();
        $aParams['{tournamentCode}'] = $tournamentCode;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_LOBBY_EVENTS_BY_CODE, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A, RequestManager::METHOD_GET);
        return new LobbyEventDTOWrapper($data);
    }

    /**
     * Creates a tournament provider and returns its ID<br>
     * Providers will need to call this endpoint first to register their 
     * callback URL and their API key with the tournament system before any 
     * other tournament provider endpoints will work.
     * @param ProviderRegistrationParameters $oProviderRegistrationParameters The provider definition.
     * @return int
     */
    public function postTournamentPublicProvider(ProviderRegistrationParameters $oProviderRegistrationParameters) {
        $aParams = $this->defaultParams();
        $aParams['ProviderRegistrationParameters'] = $oProviderRegistrationParameters;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_PROVIDER, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A, RequestManager::METHOD_POST);
        return $data;
    }

    /**
     * Creates a tournament provider and returns its ID<br>
     * Providers will need to call this endpoint first to register their callback 
     * URL and their API key with the tournament system before any other 
     * tournament provider endpoints will work.
     * @param TournamentRegistrationParameters $oTournamentRegistrationParameters The tournament definition.
     * @return int
     */
    public function postTournamentPublicTournament(TournamentRegistrationParameters $oTournamentRegistrationParameters) {
        $aParams = $this->defaultParams();
        $aParams['TournamentRegistrationParameters'] = $oTournamentRegistrationParameters;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_TOURNAMENT, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_A, RequestManager::METHOD_POST);
        return $data;
    }

    /**
     * Retrieve match by match ID and tournament code. (REST)
     * @param long $matchId The ID of the match.
     * @param string $tournamentCode The tournament code of the match
     * @param boolean $includeTimeline Flag indicating whether or not to include match timeline data
     * @return MatchDetail
     */
    public function getMatchListForTournament($matchId, $tournamentCode, $includeTimeline = null) {
        $aParams = $this->defaultParams();
        $aParams['{matchId}'] = $matchId;
        if ($includeTimeline !== null) {
            $aParams['includeTimeline'] = $includeTimeline ? 'true' : 'false';
        }
        $aParams['tournamentCode'] = $tournamentCode;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_MATCH_FOR_TOURNAMENT, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return new MatchDetail($data);
    }
    
    /**
     * Retrieve match by match ID and tournament code. (REST)
     * @param long $matchId The ID of the match.
     * @param string $tournamentCode The tournament code of the match
     * @param boolean $includeTimeline Flag indicating whether or not to include match timeline data
     * @return MatchDetail
     */
    public function getMatchIdsByTournament($tournamentCode) {
        $aParams = $this->defaultParams();
        $aParams['{tournamentCode}'] = $tournamentCode;
        $data = $this->doRequest(URLs::R_URL_TOURNAMENT_PUBLIC_MATCH_BY_TOURNAMENT, $aParams, __FUNCTION__, CacheManager::TIME_ELAPSED_B);
        return $data;
    }

    // </editor-fold>
}
