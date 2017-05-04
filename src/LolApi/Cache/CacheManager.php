<?php

namespace LolApi\Cache;

/**
 * Cache manager es la clase que se encarga de controlar el acceso a la cache de LolApi
 *
 * @author Javier
 */
class CacheManager {

    /**
     * Cache statica desabilitada
     */
    const TIME_ELAPSED_NONE = 0;

    /**
     * 1 minuto
     */
    const TIME_ELAPSED_A = 60;

    /**
     * 10 minutos
     */
    const TIME_ELAPSED_A2 = 600;
    
    /**
     * 1 hora
     */
    const TIME_ELAPSED_B = 3600;

    /**
     * 1 día
     */
    const TIME_ELAPSED_C = 86400;

    /**
     * 1 semana
     */
    const TIME_ELAPSED_D = 604800;

    /**
     * Variable que guarda la carpeta en la que se hubica la cache
     * @var string 
     */
    public static $static_cache_folder = __DIR__ . '/cache_files/';

    /**
     * Cache dinamica, su formato es key=>data
     * @var array 
     */
    public static $dinamic_cache = [];

    public function __construct() {
        
    }

    /**
     * Crea el indice de la cache ( o el nombre del fichero )
     * @param array $aParams parametros de ataque a la url
     * @param string $function funcion inicial que comienza con la peticion
     * @return string
     */
    public function createCacheIndex($aParams, $function) {
        if (isset($aParams['api_key'])) {
            unset($aParams['api_key']);
        }
        return $function . implode($aParams);
    }

    /**
     * Recupera los datos de la cache teniendo en cuenta la cache dinamica y la estatica (o de ficheros)
     * @param string $cacheIndex indice o nombre de fichero de la cache
     * @param int $maxTimeElapsed tiempo en segundos que se le permite a la cache estatica durar. 
     * @return string
     */
    public function getData($cacheIndex, $maxTimeElapsed, $flag_force_cache) {
        $data = $this->getDataFromDinamicCache($cacheIndex);
        if (!$data) {
            $data = $this->getDataFromStaticCache($cacheIndex, $maxTimeElapsed, $flag_force_cache);
        }
        return $data;
    }

    /**
     * Recupera los datos de la cache dinamica o devuelve falso en caso negativo
     * @param string $cacheIndex indice de la cache dinamica para acceder a los datos
     * @return string or false
     */
    public function getDataFromDinamicCache($cacheIndex) {
        return isset(self::$dinamic_cache[$cacheIndex]) ? self::$dinamic_cache[$cacheIndex] : false;
    }

    /**
     * Recupera los datos de la cache estatica
     * @param string $cacheIndex nombre del archivo de la cache estatica
     * @param int $maxTimeElapsed segundos para que el archivo caduque
     * @return string or false
     */
    public function getDataFromStaticCache($cacheIndex, $maxTimeElapsed, $flag_force_cache) {
        $filepath = self::$static_cache_folder . $cacheIndex . '.json';
        return (($maxTimeElapsed > self::TIME_ELAPSED_NONE && file_exists($filepath) && abs(time() - filemtime($filepath)) < $maxTimeElapsed) || ($flag_force_cache && file_exists($filepath))) ? file_get_contents($filepath) : false;
    }

    /**
     * Añade los datos a los dos tipos de cache
     * @param string $cacheIndex
     * @param string $data
     */
    public function addDataToCache($cacheIndex, $data) {
        $this->addDataToDinamicCache($cacheIndex, $data);
        $this->addDataToStaticCache($cacheIndex, $data);
    }

    /**
     * Añade datos a la cache dinamica
     * @param string $cacheIndex
     * @param string $data
     */
    public function addDataToDinamicCache($cacheIndex, $data) {
        self::$dinamic_cache[$cacheIndex] = $data;
    }

    /**
     * Añade datos a la cache estatica
     * @param string $cacheIndex
     * @param string $data
     */
    public function addDataToStaticCache($cacheIndex, $data) {
        file_put_contents(self::$static_cache_folder . $cacheIndex . '.json', $data);
    }

    /**
     * Elimina toda la cache
     */
    public function clearCache() {
        foreach (glob(self::$static_cache_folder . '*.json') as $file) {
            unlink($file);
        }
    }

}
