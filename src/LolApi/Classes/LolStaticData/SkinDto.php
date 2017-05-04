<?php

namespace LolApi\Classes\LolStaticData;

/**
 * SkinDto
 * This object contains champion skin data.
 * @author Javier
 */
class SkinDto {

    /**
     *
     * @var int
     */
    public $id;

    /**
     *
     * @var string 
     */
    public $name;

    /**
     *
     * @var int 
     */
    public $num;

    function __construct($d) {
        $this->id = $d->id;
        $this->name = $d->name;
        $this->num = $d->num;
    }

    
    /**
     * Construye la imagen del Champion Splash Art
     * @param int $key
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionSplashArt_ImageTag($key, $imgTitle = null, $imgClass = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_splash_art($key, $this->num, $imgTitle ? $imgTitle : $key.': '.$this->name.' splah art', $imgClass, $tooltip);
    }

    /**
     * Construye la imagen del Champion Loading Screen Art
     * @param int $key
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionLoadingScreenArt_ImageTag($key, $imgTitle = null, $imgClass = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_loading_screen_art($key, $this->num, $imgTitle ? $imgTitle : $key.': '.$this->name.' loading art', $imgClass, $tooltip);
    }
    
}
