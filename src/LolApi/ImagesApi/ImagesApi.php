<?php

namespace LolApi\ImagesApi;

use LolApi\URLs;
use LolApi\ImagesApi\ImageTag;

/**
 * LolImageApi
 * Se encarga de construir las urls a las imagenes
 * @author Javier
 */
class ImagesApi {
    // <editor-fold defaultstate="collapsed" desc="# ~ METODOS PRINCIPALES ~ #">

    /** @var string */
    private $v;

    public function __construct() {
        
    }

    /**
     * Devuelve la version para las imagenes
     * @return string
     */
    private function getV() {
        if ($this->v == null) {
            $this->v = \LolApi\LolApi::globalApi()->getRealmDto()->v;
        }
        return $this->v;
    }

    /**
     * Construye la url de la imagen
     * @param string $resourceUrl
     * @param array $aParams
     * @return string
     */
    private function buildSrc($resourceUrl, $aParams) {
        foreach ($aParams as $paramkey => $value) {
            $resourceUrl = str_replace($paramkey, $value, $resourceUrl);
        }
        return $resourceUrl;
    }

    /**
     * Construye y devuelve el objeto de ImageTag
     * @param string $resourceUrl url de destino
     * @param array $aParams parametros para sustituir en la ulr
     * @param string $imgTitle titulo de la imagen
     * @param string $imgClass clase adicional para la imagen
     * @param string $alt alt de la imagen
     * @param string $tooltip
     * @return ImageTag
     */
    private function getImageTag($resourceUrl, $aParams, $imgTitle = null, $imgClass = null, $alt = null, $tooltip = null) {
        $aAttributes['class'] = $alt . ($imgClass ? ' ' . $imgClass : '');
        if ($tooltip != null) {
            $aAttributes['tool-tip'] = $tooltip;
        }
        $alt = str_replace('_', '-', $alt) . implode('-', $aParams);
        return new ImageTag($this->buildSrc($resourceUrl, $aParams), $imgTitle, $alt, $aAttributes);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="# ~ METODOS DE LA API ~ #">

    /**
     * Construye la imagen del perfil de invocador
     * @param int $id
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function profile_icon($id, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{id}"] = $id;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_PROFILE_ICONS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen del Champion Splash Art
     * @param int $key
     * @param int $num
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function champion_splash_art($key, $num, $imgTitle = null, $imgClass = null, $tooltip = null) {
        $aParams["{key}"] = $key;
        $aParams["{num}"] = $num;
        return $this->getImageTag(URLs::IMG_URL_CHAMPIONS_SPLASH_ART, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen del Champion Loading Screen Art
     * @param int $key
     * @param int $num
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $tooltip
     * @return ImageTag
     */
    public function champion_loading_screen_art($key, $num, $imgTitle = null, $imgClass = null, $tooltip = null) {
        $aParams["{key}"] = $key;
        $aParams["{num}"] = $num;
        return $this->getImageTag(URLs::IMG_URL_CHAMPIONS_LOADING_SCREEN_ART, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen del Champion Loading Screen Art
     * @param string $full
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function champion_square($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_CHAMPIONS_SQUARE, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen correspniente a la pasiva de un campeon
     * @param int $key
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function champion_passive_ability($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_CHAMPIONS_PASSIVE_ABILITIES, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen correspondiente a la habildiad del campeon pasada
     * @param string $full
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function champion_ability($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_CHAMPIONS_ABILITIES, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen del hechizo de invocador
     * @param string $full
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function summoner_spell($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_SUMMONER_SPELLS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * construye la imagen del item
     * @param int $id
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function item($id, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{id}"] = $id;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_ITEMS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * construye la imagen de la maestria
     * @param string $full
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function mastery($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_MASTERIES, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * construye la imagen de la runa
     * @param string $full
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function rune($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_RUNES, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * construye el sprite pasado. 
     * @param string $full
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function sprite($full, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{full}"] = $full;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_SPRITES, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * construye la imagen del minimapa
     * @param int $id
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function minimap($id, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{id}"] = $id;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_MINIMAPS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Devuevle los iconos del scoreboard (al final de la partida)
     * @see https://developer.riotgames.com/docs/static-data
     * @param string $icon
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function score_board_icon($icon, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{icon"] = $icon;
        $aParams["{v}"] = $v ? $v : $this->getV();
        return $this->getImageTag(URLs::IMG_URL_SCOREBOARD_ICONS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen base del tier (sin la division)
     * @param string $tier Tier al que corresponde la liga (por ejemplo, gold, silver, etc) Usar LeagueDto::TIER_...
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function tier_base_icon($tier, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{tier}"] = $tier ? strtolower($tier) : 'provisional';
        return $this->getImageTag(URLs::IMG_URL_TIER_BASE_ICONS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    /**
     * Construye la imagen base del tier (sin la division)
     * @param string $tier Tier al que corresponde la liga (por ejemplo, gold, silver, etc) Usar LeagueDto::TIER_...
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function tier_division_icon($tier, $division, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        $aParams["{tier}"] = strtolower($tier);
        $aParams["{division}"] = strtolower($division);
        return $this->getImageTag(URLs::IMG_URL_TIER_DIVISION_ICONS, $aParams, $imgTitle, $imgClass, __FUNCTION__, $tooltip);
    }

    // </editor-fold>
}
