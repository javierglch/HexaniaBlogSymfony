<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ChampionSpellDto
 * This object contains champion spell data.
 * @author Javier
 */
class ChampionSpellDto {

    /**
     * 
     * @var ImageDto array
     */
    public $altimages;

    /**
     * 
     * @var array double
     */
    public $cooldown;

    /**
     * 
     * @var string
     */
    public $cooldownBurn;

    /**
     * 
     * @var array ing
     */
    public $cost;

    /**
     * 
     * @var string
     */
    public $costBurn;

    /**
     * 
     * @var string
     */
    public $costType;

    /**
     * 
     * @var string
     */
    public $description;

    /**
     * This field is a List of List of Double.
     * @var array
     */
    public $effect;

    /**
     * 
     * @var array string
     */
    public $effectBurn;

    /**
     * 
     * @var ImageDto
     */
    public $image;

    /**
     * 
     * @var string
     */
    public $key;

    /**
     * 
     * @var LevelTipDto
     */
    public $leveltip;

    /**
     * 
     * @var int
     */
    public $maxrank;

    /**
     * 
     * @var string
     */
    public $name;

    /**
     * This field is either a List of Integer or the String 'self' for spells that target one's own champion.
     * @var mixed
     */
    public $range;

    /**
     * 
     * @var string
     */
    public $rangeBurn;

    /**
     * 
     * @var string
     */
    public $resource;

    /**
     * 
     * @var string
     */
    public $sanitizedDescription;

    /**
     * 
     * @var string
     */
    public $sanitizedTooltip;

    /**
     * 
     * @var string
     */
    public $tooltip;

    /**
     * 
     * @var SpellVarsDto array
     */
    public $vars;

    function __construct($data) {
        $this->altimages = [];
        foreach ($data->altimages as $o) {
            $this->altimages[] = new ImageDto($o);
        }
        $this->cooldown = $data->cooldown;
        $this->cooldownBurn = $data->cooldownBurn;
        $this->cost = $data->cost;
        $this->costBurn = $data->costBurn;
        $this->costType = $data->costType;
        $this->description = $data->description;
        $this->effect = $data->effect;
        $this->effectBurn = $data->effectBurn;
        $this->image = new ImageDto($data->image);
        $this->key = $data->key;
        $this->leveltip = new LevelTipDto($data->leveltip);
        $this->maxrank = $data->maxrank;
        $this->name = $data->name;
        $this->range = $data->range;
        $this->rangeBurn = $data->rangeBurn;
        $this->resource = $data->resource;
        $this->sanitizedDescription = $data->sanitizedDescription;
        $this->sanitizedTooltip = $data->sanitizedTooltip;
        $this->tooltip = $data->tooltip;
        $this->vars = [];
        foreach ($data->vars as $o) {
            $this->vars[] = new SpellVarsDto($o);
        };
    }

    /**
     * Construye la imagen correspondiente a la habildiad del campeon pasada
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_ability($this->image->full, $imgTitle ? $imgTitle : $this->name, $imgClass, $v, $tooltip);
    }

    /**
     * Construye el tooltip de la habilidad del campeon
     * @param int $level
     * @return string
     */
    public function getTooltip($level = null) {
        preg_match_all("/({{\s[f|e]\d\s}})+/", $this->sanitizedTooltip, $matches);
        $strResultToolTip = $this->sanitizedTooltip;
        $matches = $matches[0];
        foreach ($matches as $key => $match) {
            preg_match("/\s(f|e)(\d)\s+/", $match, $matches2);
            $search = $match;
            $type_index = $matches2[1] . $matches2[2];
            $type = $matches2[1];
            $index = $matches2[2];

            $replace = '';
            if ($type == 'e') {
                $replace = $level ? $this->effect[$index][$level] : $this->effectBurn[$index];
            } elseif ($type == 'a' || $type == 'f') {
                foreach ($this->vars as $var) {
                    if ($var->key == $type_index) {
                        $replace = $var->coeff[0].' '.$var->link;
                    }
                }
            }
            $strResultToolTip = str_replace($search, $replace, $strResultToolTip);
        }
        return $strResultToolTip;
    }

}
