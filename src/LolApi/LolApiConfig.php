<?php

namespace LolApi;

/**
 * LolApiConfig
 * Lo ideal es que todo esto este en base de datos, pero bueno.
 * De momento lo ponemos aquí y más tarde lo mejoraremos
 * @author Javier
 */
class LolApiConfig {
    # -------------- #
    # ~ API CONFIG ~ #
    # -------------- #

    /**
     * Activa el uso del Debug. Por defecto es false
     * @var boolean
     */
    public $active_debug = false;

    /**
     * Activa el uso de la cache. Por defecto es true
     * @var boolean 
     */
    public $active_cache = true;

    /**
     * Activada por defecto.
     * Desactivar para no lanzar errores y romper la aplicación.
     * @var boolean
     */
    public $enable_throw_errors = true;

    /** 
     * Fuerza el uso de la cache en caso de que exista fichero, sino, usara la url. Por defecto es false
     * @var boolean 
     */
    public $force_get_cache = false;
    
    /**
     * Esta variable es temporal, lo ideal es guardarlo en una tabla en base de datos?
     * @var string
     */
    const GAME_CLIENT_RELEASE_FILE_PATH = __DIR__ . '/Cache/_release';

    /** @var string */
    public $api_key_production = 'd87b8bad-cc2c-47b5-9f43-cbcffe78c00b';

    /** @var string */
    public $api_key_development = 'RGAPI-de13121c-3a84-4793-b171-7af8eb232711';

    /** @var string */
    public $current_season = 'SEASON2017';

    /** @var string */
    public $default_locale = 'es_ES';

    /** @var string region por defecto */
    public $region = 'euw';

    /** @var array */
    public $platforms = [
        'BR' => 'BR1',
        'EUNE' => 'EUN1',
        'EUW' => 'EUW1',
        'JP' => 'JP1',
        'KR' => 'KR',
        'LAN' => 'LA1',
        'LAS' => 'LA2',
        'NA' => 'NA1',
        'OCE' => 'OC1',
        'TR' => 'TR1',
        'RU' => 'RU',
        'PBE' => 'PBE1',
    ];

    /** @var array [string[string,string]] */
    public $spectator = [
        'NA1' => ['domain' => 'spectator.na.lol.riotgames.com', 'port' => 80],
        'EUW1' => ['domain' => 'spectator.euw1.lol.riotgames.com', 'port' => 80],
        'EUN1' => ['domain' => 'spectator.eu.lol.riotgames.com', 'port' => 8088],
        'JP1' => ['domain' => 'spectator.jp1.lol.riotgames.com', 'port' => 80],
        'KR' => ['domain' => 'spectator.kr.lol.riotgames.com', 'port' => 80],
        'OC1' => ['domain' => 'spectator.oc1.lol.riotgames.com', 'port' => 80],
        'BR1' => ['domain' => 'spectator.br.lol.riotgames.com', 'port' => 80],
        'LA1' => ['domain' => 'spectator.la1.lol.riotgames.com', 'port' => 80],
        'LA2' => ['domain' => 'spectator.la2.lol.riotgames.com', 'port' => 80],
        'RU' => ['domain' => 'spectator.ru.lol.riotgames.com', 'port' => 80],
        'TR1' => ['domain' => 'spectator.tr.lol.riotgames.com', 'port' => 80],
        'PBE1' => ['domain' => 'spectator.pbe1.lol.riotgames.com', 'port' => 8088],
    ];

    function __construct() {
        
    }

    /**
     * Devuelve la platformId por region
     * @param string $region
     * @return string
     */
    public function getPlatformId($region) {
        if (!isset($this->platforms[strtoupper($region)])) {
            throw new Exceptions('LolApiConfigException - GetPLatformId: Region ' . $region . ' desconocida o no configurada.');
        }
        return $this->platforms[strtoupper($region)];
    }

    /**
     * Devuelve el numero de Game Client Release number en la que se ubica el cliente en las carpetas de windows
     * @return int Release number
     */
    public function getGameClientReleaseNumber() {
        return file_get_contents(self::GAME_CLIENT_RELEASE_FILE_PATH);
    }

    /**
     * Modifica la variable Game Client Release
     */
    public function setGameClientReleaseNumber($number) {
        file_put_contents(self::GAME_CLIENT_RELEASE_FILE_PATH, $number);
    }

    /**
     * Devuelve los datos de dominio y puerto para espectar una partida, buscados por la $platformId
     * Para recueprar la $platformId hay que utilizar LolApiConfig->getPlatformId($region)
     * @param string $platformId
     * @return array [string,string] or null
     * El array devuelto posee dos claves: 'domain' y 'port'
     */
    public function getSpectatorData($platformId) {
        $platformId = strtoupper($platformId);
        return isset($this->spectator[$platformId]) ? $this->spectator[$platformId] : null;
    }

}
