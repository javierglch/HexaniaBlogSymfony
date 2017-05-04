<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\Debug;

/**
 * Clase utilizada para recuperar la información del debug
 *
 * @author Javier
 */
class DebugInfo {

    const DEBUG_REQUEST_TYPE_URL = 'url';
    const DEBUG_REQUEST_TYPE_CACHE = 'cache';

    /** @var int */
    public $last_http_code;

    /** @var string */
    public $function;

    /** @var int */
    public $maxTimeElapsed;

    /** @var mixed */
    public $debug_request_type;

    /** @var \DateTime */
    public $datetime;

    /** @var float */
    public $timeSpent;

    /** @var string */
    public $resourceUrl;
    /** @var string */
    public $url_request_type;

    /** @var string */
    public $cacheIndex;

    /** @var array */
    public $params;

    /** @var array */
    public $fullUrl;

    /** @var mixed */
    public $data;

    /** @var \Exception or null */
    public $exception;

    /**
     * 
     * @param float $timeSpent
     * @param string $debug_request_type
     * @param string $url_request_type
     * @param string $resourceUrl
     * @param array $params
     * @param mixed $data
     * @param string $cacheIndex
     * @param string $fullUrl
     * @param string $function
     * @param int $maxTimeElapsed
     * @param int $last_http_code
     * @param \Exception $exception
     */                     
    public function __construct($timeSpent, $debug_request_type, $url_request_type, $resourceUrl, $params, $data, $cacheIndex, $fullUrl, $function, $maxTimeElapsed, $last_http_code, $exception = null) {
        $this->datetime = new \DateTime();
        $this->timeSpent = $timeSpent;
        $this->url_request_type = $url_request_type;
        $this->resourceUrl = $resourceUrl;
        $this->params = $params;
        $this->data = $data;
        $this->cacheIndex = $cacheIndex;
        $this->debug_request_type = $debug_request_type;
        $this->maxTimeElapsed = $maxTimeElapsed;
        $this->fullUrl = $fullUrl;
        $this->function = $function;
        $this->last_http_code = $last_http_code;
        $this->exception = $exception;
    }

}
