<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MapDetailsDto
 * This object contains map details data.
 * @author Javier
 */
class MapDetailsDto {

    /** @var ImageDto */
    public $image;

    /** @var long */
    public $mapId;

    /** @var string */
    public $mapName;

    /** @var array List[long] */
    public $unpurchasableItemList;

    public function __construct($d) {
        $this->image = new ImageDto($d->image);
        $this->mapId = $d->mapId;
        $this->mapName = $d->mapName;
        $this->unpurchasableItemList = $d->unpurchasableItemList;
    }

    /**
     * construye la imagen del minimapa
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return \LolApi\ImagesApi\ImageTag
     */
    public function getMiniMap_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->minimap($this->mapId, $imgTitle ? $imgTitle : $this->mapName, $imgClass, $v, $tooltip);
    }

}
