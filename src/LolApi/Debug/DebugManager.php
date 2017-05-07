<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\Debug;

use LolApi\Debug\DebugInfo;

/**
 * Clase utilizada para manegar las peticiones del debug
 *
 * @author Javier
 */
class DebugManager {
    # ---------------- #
    # ~ DEBUG CONFIG ~ #
    # ---------------- #

    /** @var int */
    public $debug_total_url_requests = 0;

    /** @var int */
    public $debug_total_cache_requests = 0;

    /** @var array DebugInfo */
    public $debug_results = [];

    /** @var int */
    public $debug_time_spent = 0;

    /** @var string */
    public $last_url;

    public function __construct() {
        
    }

    /**
     * Añade información al debug
     * @param DebugInfo $DebugInfo
     */
    public function addDebugInfo(DebugInfo $DebugInfo) {
        $this->debug_results[] = $DebugInfo;
        $this->debug_time_spent += $DebugInfo->timeSpent;
        switch ($DebugInfo->debug_request_type) {
            case DebugInfo::DEBUG_REQUEST_TYPE_CACHE: $this->debug_total_cache_requests += 1;
                break;
            case DebugInfo::DEBUG_REQUEST_TYPE_URL: $this->debug_total_url_requests += 1;
                break;
        }
    }

    /**
     * Muestra el debug en pantalla
     * @return void
     */
    public function printDebug() {
        foreach ($this->debug_results as $index => $oDebugInfo) {
            $str.= '<table style="padding:0;border:1px solid black; background:rgba(0,0,0,0.1); margin:5px;max-width:100%;">';
            $str.= '<tbody style="padding:0;margin:0;">';
            $str.= '<tr style="margin:0;padding:0">';
            $str.= '<td colspan=2 style="vertical-align: top; min-width:150px;text-align:left;margin:0;padding:0;"><div style="font-size:20px;background:rgba(0,0,0,0.5);color:white;padding:4px;width:fit-content;width:-moz-fit-content;width:-webkit-fit-content">Petición #' . ($index + 1) . '</div></td>';
            $str.= '</tr>';
            $str.= '<tr>';
            $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Funcion</th>';
            $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->function . '</td>';
            $str.= '</tr>';
            $str.= '<tr style="vertical-align: top; min-width:150px;text-align:left;">';
            $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Tipo de petición</th>';
            $str.= '<td>' . strtoupper($oDebugInfo->debug_request_type) . '</td>';
            $str.= '</tr>';
            $str.= '<tr>';
            $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Tiempo de actualización:</th>';
            $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->maxTimeElapsed . 's</td>';
            $str.= '</tr>';
            $str.= '<tr>';
            $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Tiempo gastado:</th>';
            $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->timeSpent . '</td>';
            $str.= '</tr>';
            if ($oDebugInfo->debug_request_type == DebugInfo::DEBUG_REQUEST_TYPE_URL) {
                $str.= '<tr>';
                $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Resource Url:</th>';
                $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">[' . $oDebugInfo->url_request_type . '] ' . $oDebugInfo->resourceUrl . '</td>';
                $str.= '</tr>';
                $str.= '<tr>';
                $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Url Params:</th>';
                $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">';
                if (is_array($oDebugInfo->params)) {
                    $str.= '<ul style="list-style:none;padding:0;">';
                    foreach ($oDebugInfo->params as $key => $value) {
                        $str.= '<li>' . $key . ' = ' . $value . '</li>';
                    }
                    $str.= '</ul>';
                } else {
                    $str.= $oDebugInfo->params;
                }
                $str.= '</td>';
                $str.= '</tr>';
                $str.= '<tr>';
                $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Full url:</th>';
                $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;"><a href="' . $oDebugInfo->fullUrl . '" target="_blank">' . $oDebugInfo->fullUrl . '</a></td>';
                $str.= '</tr>';
                $str.= '<tr>';
                $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">HTTP CODE:</th>';
                $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->last_http_code . '</td>';
                $str.= '</tr>';
                if ($oDebugInfo->last_http_code != 200 && $oDebugInfo->exception) {
                    $str.= '<tr>';
                    $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;"><font color="red">Excepción:</font></th>';
                    $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;"><font color="red">';
                    $str.= '<strong>' . $oDebugInfo->exception->getCode() . ' - ' . $oDebugInfo->exception->getMessage() . '</strong>';
                    $str.= '<ul style="padding-left:10px;margin:0;">';
                    foreach ($oDebugInfo->exception->getTrace() as $trace) {
                        $str.= '<li>' . $trace['file'] . ' (' . $trace['line'] . ') - ' . $trace['class'] . '-><strong>' . $trace['function'] . '(' . implode(',', $trace['args']) . ')</strong></li>';
                    }
                    $str.= '</ul>';
                    $str.= '</font></td>';
                    $str.= '</tr>';
                }
            } elseif ($oDebugInfo->debug_request_type == DebugInfo::DEBUG_REQUEST_TYPE_CACHE) {
                $str.= '<tr>';
                $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Cache Index:</th>';
                $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;"><a target="_blank" href="' . str_replace('/', '\\', \LolApi\Cache\CacheManager::$static_cache_folder) . $oDebugInfo->cacheIndex . '.json">' . $oDebugInfo->cacheIndex . '</a></td>';
                $str.= '</tr>';
            }
            if ($oDebugInfo->last_http_code == 200) {
                $str.= '<tr>';
                $str.= '<th style="vertical-align: top; min-width:150px;text-align:left;">Datos:</th>';
                $str.= '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->data . '</td>';
                $str.= '</tr>';
            }
            $str.= '</tbody>';
            $str.= '</table>';
        }

        $str.= '<ul>';
        $str.= '<li>Tiempo total dedicado: ' . $this->debug_time_spent . '</li>';
        $str.= '<li>Peticiones de URL: ' . $this->debug_total_url_requests . '</li>';
        $str.= '<li>Peticiones de Caché: ' . $this->debug_total_cache_requests . '</li>';
        $str.= '<li>Número total de peticiones: ' . $this->getTotalRequests() . '</li>';
        $str.= '</ul>';
        $str.= '</div>';
        return $str;
    }

    /**
     * suma todas las peticiones
     * @return int
     */
    public function getTotalRequests() {
        return $this->debug_total_url_requests + $this->debug_total_cache_requests;
    }

    public function __toString() {
        return $this->printDebug();
    }

}
