<?php

namespace LolApi\Classes\LolStaticData;

/**
 * BlockDto
 * This object contains champion recommended block data.
 * @author Javier
 */
class BlockDto {

    /**
     * 
     * @var array
     */
    public $items;

    /**
     * 
     * @var boolean
     */
    public $recMath;

    /**
     * 
     * @var string
     */
    public $type;

    function __construct($d) {
        $this->items = [];
        foreach ($d->items as $o) {
            $this->items[] = new BlockItemDto($o);
        }
        $this->recMath = $d->recMath;
        $this->type = $d->type;
    }

}
