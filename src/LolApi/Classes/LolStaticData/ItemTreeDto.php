<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ItemTreeDto
 * This object contains item tree data.
 * @author Javier
 */
class ItemTreeDto {

    /**
     *
     * @var string 
     */
    public $header;

    /**
     *
     * @var array List[string]
     */
    public $tags;

    function __construct($d) {
        $this->header = $d->header;
        $this->tags = $d->tags;
    }

}
