<?php

namespace LolApi\Classes\LolStaticData;

/**
 * PassiveDto
 * This object contains champion passive data.
 * @author Javier
 */
class PassiveDto {
    
    /**
     * 
     * @var string
     */
    public $description;
    /**
     * 
     * @var ImageDto
     */
    public $image;
    /**
     * 
     * @var string
     */
    public $name;
    /**
     * 
     * @var string
     */
    public $sanitizedDescription;
    
    function __construct($d) {
        $this->description = $d->description;
        $this->image = new ImageDto($d->image);
        $this->name = $d->name;
        $this->sanitizedDescription = $d->sanitizedDescription;
    }

    /**
     * Construye la imagen correspniente a la pasiva de un campeon
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return ImageTag
     */
    public function getIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->champion_passive_ability($this->image->full, $imgTitle ? $imgTitle : $this->name, $imgClass, $v, $tooltip);
    }
}
