<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ImageDto
 * This object contains image data.
 * @author Javier
 */
class ImageDto {

    /**
     * 
     * @var string
     */
    public $full;

    /**
     * 
     * @var string
     */
    public $group;

    /**
     * 
     * @var int
     */
    public $h;

    /**
     * 
     * @var string
     */
    public $sprite;

    /**
     * 
     * @var int
     */
    public $w;

    /**
     * 
     * @var int
     */
    public $x;

    /**
     * 
     * @var int
     */
    public $y;

    function __construct($d) {
        $this->full = $d->full;
        $this->group = $d->group;
        $this->sprite = $d->sprite;
        $this->w = $d->w;
        $this->h = $d->h;
        $this->x = $d->x;
        $this->y = $d->y;
    }

    /**
     * construye el sprite pasado. 
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getSprite($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->sprite($this->sprite, $imgTitle, $imgClass, $v, $tooltip);
    }

}
