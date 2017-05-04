<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MasteryDto
 * This object contains mastery data.
 * @author Javier
 */
class MasteryDto {

    // ~ masteryData ~
    const MASTERYDATA_ALL = 'all';
    const MASTERYDATA_IMAGE = 'image';
    const MASTERYDATA_MASTERY_TREE = 'masteryTree';
    const MASTERYDATA_PREREQ = 'prereq';
    const MASTERYDATA_RANKS = 'ranks';
    const MASTERYDATA_SANITIZED_DESCRIPTION = 'sanitizedDescription';

    /** @var array List[string] */
    public $description;

    /** @var int */
    public $id;

    /** @var ImageDto */
    public $image;

    /**
     * Legal values: Cunning, Ferocity, Resolve
     * @var string 
     */
    public $masteryTree;

    /** @var string */
    public $name;

    /** @var string */
    public $prereq;

    /** @var int */
    public $ranks;

    /** @var array List[string]	 */
    public $sanitizedDescription;

    public function __construct($d) {
        $this->description = $d->description;
        $this->id = $d->id;
        $this->image = new ImageDto($d->image);
        $this->masteryTree = $d->masteryTree;
        $this->name = $d->name;
        $this->prereq = $d->prereq;
        $this->ranks = $d->ranks;
        $this->sanitizedDescription = $d->sanitizedDescription;
    }

    /**
     * construye la imagen de la maestria
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->mastery($this->image->full, $imgTitle ? $imgTitle : $this->name, $imgClass, $v, $tooltip ? $tooltip : $this->description);
    }

}
