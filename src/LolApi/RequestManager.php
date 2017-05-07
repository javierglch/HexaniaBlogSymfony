<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi;

use LolApi\Cache\CacheManager;
use LolApi\Debug\DebugManager;
use LolApi\Debug\DebugInfo;
use LolApi\Exceptions\BadRequestException;
use LolApi\Exceptions\UnauthorizedException;
use LolApi\Exceptions\PaymentRequiredException;
use LolApi\Exceptions\ForbiddenException;
use LolApi\Exceptions\NotFoundException;
use LolApi\Exceptions\RateLimitExceededException;
use LolApi\Exceptions\InternalServerErrorException;
use LolApi\Exceptions\NotImplementedException;
use LolApi\Exceptions\ServiceTemporarilyOverloadedException;
use LolApi\Exceptions\ServiceUnavailableException;

/**
 * Maneja la peticion, se encarga de coger los datos de la cache o de la url
 * @author Javier
 */
class RequestManager {

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * @var CacheManager 
     */
    public $CacheManager = null;

    /** @var DebugManager */
    public $DebugManager = null;

    /** @var int */
    public $last_http_code = null;

    public function __construct() {
        $this->CacheManager = new CacheManager();
        $this->DebugManager = new DebugManager();
    }

    /**
     * Comprueba se se ha producido alguna excepción con el codigo de respuesta
     * @param int $code
     * @throws BadRequestException
     * @throws UnauthorizedException
     * @throws PaymentRequiredException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws RateLimitExceededException
     * @throws InternalServerErrorException
     * @throws NotImplementedException
     * @throws ServiceTemporarilyOverloadedException
     * @throws ServiceUnavailableException
     */
    private function checkResponseHttpCode($code) {
        switch ($code) {
            case 204:
                throw new NotFoundException("Error 204: Data Non-existent", 204);
            case 400:
                throw new BadRequestException("Error 400: Bad Request", 400);
            case 401:
                throw new UnauthorizedException("Error 401: Unauthorized", 401);
            case 402:
                throw new PaymentRequiredException("Error 402: Payment Required", 402);
            case 403:
                throw new ForbiddenException("Error 403: Forbidden", 403);
            case 404:
                throw new NotFoundException("Error 404: Not Found", 404);
            case 422:
                throw new NotFoundException("Error 422: Summoner has an entry, but hasn't played since the start of 2013", 422);
            case 429:
                throw new RateLimitExceededException("Error 429: Rate limit exceeded", 429);
            case 500:
                throw new InternalServerErrorException("Error 500: Internal Server Error", 500);
            case 501:
                throw new NotImplementedException("Error 501: Not Implemented", 501);
            case 502:
                throw new ServiceTemporarilyOverloadedException("Error 502: Service Temorarily Overloaded", 502);
            case 503:
                throw new ServiceUnavailableException("Error 503: Service unavailable", 503);
        }
    }

    /**
     * Recupera los datos teniendo en cuenta la Cache y la Url
     * @param string $resourceUrl url sin parametros, sacada de dal clase URLs
     * @param array $aParams parametros para la url
     * @param string $function funcion utilizada para indexar la cache
     * @param int $maxTimeElapsed maximo tiempo de uso de la cache estatica
     * @param LolApiConfig $LolApiConfig objeto LolApiConfig
     * @param string $method tipo de peticion. Usar RequestManager::METHOD_...
     * @return string
     */
    public function doRequest($resourceUrl, $aParams, $function, $maxTimeElapsed, LolApiConfig $LolApiConfig, $method) {
        $begin_microtime = microtime(true);
        $data = null;
        $debug_request_type = null;
        $cacheIndex = $this->CacheManager->createCacheIndex($aParams, $function);
        $strParams = ($method == RequestManager::METHOD_GET) ? null : http_build_query($aParams);
        $fullUrl = null;

        try {

            // Peticion a cache
            if (($LolApiConfig->active_cache && $method == RequestManager::METHOD_GET) || $LolApiConfig->force_get_cache && $method != RequestManager::METHOD_GET) {
                $debug_request_type = DebugInfo::DEBUG_REQUEST_TYPE_CACHE;
                $data = $this->CacheManager->getData($cacheIndex, $maxTimeElapsed, $LolApiConfig->force_get_cache);
            }

            // Peticion a URL
            if (!$data) {
                $fullUrl = ($method == RequestManager::METHOD_GET) ? $this->buildUrlForGETRequest($resourceUrl, $aParams) : $this->buildUrlForPOSTRequest($resourceUrl, $aParams);
                $this->DebugManager->last_url = $fullUrl;
                $debug_request_type = DebugInfo::DEBUG_REQUEST_TYPE_URL;
                $data = ($method == RequestManager::METHOD_GET) ? $this->getDataFromURL($fullUrl) : $this->postDataToURL($fullUrl, $strParams, $method);

                //guardamos en cache
                if ($LolApiConfig->active_cache) {
                    $this->CacheManager->addDataToCache($cacheIndex, $data);
                }
            }

            //guardamos debug de la peticion
            if ($LolApiConfig->active_debug) {
                $end_microtime = microtime(true);
                $timeSpent = $end_microtime - $begin_microtime;
                $this->DebugManager->addDebugInfo(new DebugInfo($timeSpent, $debug_request_type, $method, $resourceUrl, ($method == RequestManager::METHOD_GET) ? $aParams : $strParams, $data, $cacheIndex, $fullUrl, $function, $maxTimeElapsed, $this->last_http_code));
            }
        } catch (\Exception $exception) {
            //guardamos debug de la peticion
            if ($LolApiConfig->active_debug) {
                $end_microtime = microtime(true);
                $timeSpent = $end_microtime - $begin_microtime;
                $this->DebugManager->addDebugInfo(new DebugInfo($timeSpent, $debug_request_type, $method, $resourceUrl, ($method == RequestManager::METHOD_GET) ? $aParams : $strParams, $data, $cacheIndex, $fullUrl, $function, $maxTimeElapsed, $this->last_http_code, $exception));
            }
            //lanzamos la excepción
            if ($LolApiConfig->enable_throw_errors) {
                throw $exception;
            }
        }
        return $data;
    }

    /**
     * Construye la url
     * @param string $resourceUrl
     * @param array $aParams
     * @return string
     */
    private function buildUrlForGETRequest($resourceUrl, $aParams) {
        foreach ($aParams as $paramkey => $value) {
            if (preg_match('/' . $paramkey . '/', $resourceUrl)) {
                $resourceUrl = str_replace($paramkey, rawurlencode($value), $resourceUrl);
                unset($aParams[$paramkey]);
            }
        }
        return $resourceUrl . "?" . http_build_query($aParams);
    }

    /**
     * Recupera los datos de la URL
     * @param string $url
     * @return string respuesta de la url
     * @throws Exception multiples excepciones segun la respuesta del servidor
     */
    private function getDataFromURL($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        $this->last_http_code = curl_getinfo($ch)['http_code'];
        $this->checkResponseHttpCode($this->last_http_code);
        echo curl_error($ch);
        return $output;
    }

    /**
     * Construye la url
     * @param string $resourceUrl
     * @param array $aParams
     * @return string
     */
    private function buildUrlForPOSTRequest($resourceUrl, &$aParams) {
        foreach ($aParams as $paramkey => $value) {
            if (preg_match('/' . $paramkey . '/', $resourceUrl)) {
                $resourceUrl = str_replace($paramkey, rawurlencode($value), $resourceUrl);
                unset($aParams[$paramkey]);
            }
        }
        return $resourceUrl;
    }

    /**
     * Recupera los datos de la URL
     * @param string $url
     * @param array $params
     * @return string respuesta de la url
     * @throws Exception multiples excepciones segun la respuesta del servidor
     */
    private function postDataToURL($url, $params, $customRequestType = 'POST') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $customRequestType);
        $output = curl_exec($ch);
        $this->last_http_code = curl_getinfo($ch)['http_code'];
        $this->checkResponseHttpCode($this->last_http_code);
        curl_close($ch);
        return $output;
    }

}
