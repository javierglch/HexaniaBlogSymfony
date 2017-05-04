<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ChampionDto - StaticChampionDto
 * This object contains champion data.
 * @author Javier
 */
class ChampionDto {

    /**
     * 
     * @var array string
     */
    public $allytips;

    /**
     * 
     * @var string
     */
    public $blurb;

    /**
     * 
     * @var array string
     */
    public $enemytips;

    /**
     * 
     * @var int
     */
    public $id;

    /**
     * 
     * @var ImageDto
     */
    public $image;

    /**
     * 
     * @var InfoDto
     */
    public $info;

    /**
     * 
     * @var string
     */
    public $key;

    /**
     * 
     * @var string
     */
    public $lore;

    /**
     * 
     * @var string
     */
    public $name;

    /**
     * 
     * @var string
     */
    public $partype;

    /**
     * 
     * @var PassiveDto
     */
    public $passive;

    /**
     * 
     * @var RecommendedDto array
     */
    public $recommended;

    /**
     * 
     * @var SkinDto array
     */
    public $skins;

    /**
     * 
     * @var ChampionSpellDto array
     */
    public $spells;

    /**
     * 
     * @var StatsDto 
     */
    public $stats;

    /**
     * 
     * @var array strings
     */
    public $tags;

    /**
     * 
     * @var string
     */
    public $title;

    function __construct($data) {
        $this->allytips = $data->allytips;
        $this->blurb = $data->blurb;
        $this->enemytips = $data->enemytips;
        $this->id = $data->id;
        $this->image = new ImageDto($data->image);
        $this->info = new InfoDto($data->info);
        $this->key = $data->key;
        $this->lore = $data->lore;
        $this->name = $data->name;
        $this->partype = $data->partype;
        $this->passive = new PassiveDto($data->passive);
        $this->recommended = [];
        foreach ($data->recommended as $o) {
            $this->recommended[] = new RecommendedDto($o);
        }
        $this->skins = [];
        foreach ($data->skins as $o) {
            $this->skins[] = new SkinDto($o);
        }
        $this->spells = [];
        foreach ($data->spells as $o) {
            $this->spells[] = new ChampionSpellDto($o);
        }
        $this->stats = new StatsDto($data->stats);
        $this->tags = $data->tags;
        $this->title = $data->title;
    }

    /*
     * champion_splash_art $key, $num
     * champion_loading_screen_art($key, $num
     * champion_sqare_art($key
     * champion_passive_ability($key,
     * champion_ability($full,
     * sprite($full,
     */

    /**
     * Construye la imagen del Champion Splash Art
     * @param int $num indice de la skin, comienza por 0
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionSplashArt_ImageTag($num = 0, $imgTitle = null, $imgClass = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_splash_art($this->key, $num, $imgTitle ? $imgTitle : $this->name . ', ' . $this->title . ' - ' . $this->skins[$num]->name, $imgClass, $tooltip);
    }

    /**
     * Construye la imagen del Champion Loading Screen Art
     * @param int $num
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionLoadingScreenArt_ImageTag($num = 0, $imgTitle = null, $imgClass = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_loading_screen_art($this->key, $num, $imgTitle ? $imgTitle : $this->name . ', ' . $this->title . ' - ' . $this->skins[$num]->name, $imgClass, $tooltip);
    }

    /**
     * Construye la imagen del Champion Loading Screen Art
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionSquare_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_square($this->image->full, $imgTitle ? $imgTitle : $this->name . ', ' . $this->title, $imgClass, $v, $tooltip);
    }

    /**
     * Construye la imagen correspniente a la pasiva de un campeon
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionPassiveAbility_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_passive_ability($this->passive->image->full, $imgTitle ? $imgTitle : $this->passive->name, $imgClass, $v, $tooltip);
    }

    /**
     * Construye la imagen correspondiente a la habildiad del campeon pasada
     * @param int $spellNum indice del spell 0=Q, 1=W, 2=E, 3=R
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getChampionAbilityArt_ImageTag($spellNum = 0, $imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_ability($this->spells[$spellNum]->image->full, $imgTitle ? $imgTitle : $this->spells[$spellNum]->name, $imgClass, $v, $tooltip);
    }

}
