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
            echo '<table style="padding:0;border:1px solid black; background:rgba(0,0,0,0.1); margin:5px;max-width:100%;">';
            echo '<tbody style="padding:0;margin:0;">';
            echo '<tr style="margin:0;padding:0">';
            echo '<td colspan=2 style="vertical-align: top; min-width:150px;text-align:left;margin:0;padding:0;"><div style="font-size:20px;background:rgba(0,0,0,0.5);color:white;padding:4px;width:fit-content;width:-moz-fit-content;width:-webkit-fit-content">Petición #' . ($index + 1) . '</div></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Funcion</th>';
            echo '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->function . '</td>';
            echo '</tr>';
            echo '<tr style="vertical-align: top; min-width:150px;text-align:left;">';
            echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Tipo de petición</th>';
            echo '<td>' . strtoupper($oDebugInfo->debug_request_type) . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Tiempo de actualización:</th>';
            echo '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->maxTimeElapsed . 's</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Tiempo gastado:</th>';
            echo '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->timeSpent . '</td>';
            echo '</tr>';
            if ($oDebugInfo->debug_request_type == DebugInfo::DEBUG_REQUEST_TYPE_URL) {
                echo '<tr>';
                echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Resource Url:</th>';
                echo '<td style="vertical-align: top; min-width:150px;text-align:left;">[' . $oDebugInfo->url_request_type . '] ' . $oDebugInfo->resourceUrl . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Url Params:</th>';
                echo '<td style="vertical-align: top; min-width:150px;text-align:left;">';
                if (is_array($oDebugInfo->params)) {
                    echo '<ul style="list-style:none;padding:0;">';
                    foreach ($oDebugInfo->params as $key => $value) {
                        echo '<li>' . $key . ' = ' . $value . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo $oDebugInfo->params;
                }
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Full url:</th>';
                echo '<td style="vertical-align: top; min-width:150px;text-align:left;"><a href="' . $oDebugInfo->fullUrl . '" target="_blank">' . $oDebugInfo->fullUrl . '</a></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th style="vertical-align: top; min-width:150px;text-align:left;">HTTP CODE:</th>';
                echo '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->last_http_code . '</td>';
                echo '</tr>';
                if ($oDebugInfo->last_http_code != 200 && $oDebugInfo->exception) {
                    echo '<tr>';
                    echo '<th style="vertical-align: top; min-width:150px;text-align:left;"><font color="red">Excepción:</font></th>';
                    echo '<td style="vertical-align: top; min-width:150px;text-align:left;"><font color="red">';
                    echo '<strong>' . $oDebugInfo->exception->getCode() . ' - ' . $oDebugInfo->exception->getMessage() . '</strong>';
                    echo '<ul style="padding-left:10px;margin:0;">';
                    foreach ($oDebugInfo->exception->getTrace() as $trace) {
                        echo '<li>' . $trace['file'] . ' (' . $trace['line'] . ') - ' . $trace['class'] . '-><strong>' . $trace['function'] . '(' . implode(',', $trace['args']) . ')</strong></li>';
                    }
                    echo '</ul>';
                    echo '</font></td>';
                    echo '</tr>';
                }
            } elseif ($oDebugInfo->debug_request_type == DebugInfo::DEBUG_REQUEST_TYPE_CACHE) {
                echo '<tr>';
                echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Cache Index:</th>';
                echo '<td style="vertical-align: top; min-width:150px;text-align:left;"><a target="_blank" href="' . str_replace('/', '\\', \LolApi\Cache\CacheManager::$static_cache_folder) . $oDebugInfo->cacheIndex . '.json">' . $oDebugInfo->cacheIndex . '</a></td>';
                echo '</tr>';
            }
            if ($oDebugInfo->last_http_code == 200) {
                echo '<tr>';
                echo '<th style="vertical-align: top; min-width:150px;text-align:left;">Datos:</th>';
                echo '<td style="vertical-align: top; min-width:150px;text-align:left;">' . $oDebugInfo->data . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }

        echo '<ul>';
        echo '<li>Tiempo total dedicado: ' . $this->debug_time_spent . '</li>';
        echo '<li>Peticiones de URL: ' . $this->debug_total_url_requests . '</li>';
        echo '<li>Peticiones de Caché: ' . $this->debug_total_cache_requests . '</li>';
        echo '<li>Número total de peticiones: ' . $this->getTotalRequests() . '</li>';
        echo '</ul>';
        echo '</div>';
    }

    /**
     * suma todas las peticiones
     * @return int
     */
    public function getTotalRequests() {
        return $this->debug_total_url_requests + $this->debug_total_cache_requests;
    }

}
