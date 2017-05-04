<?php

namespace LolApi\Classes\LolStaticData;

/**
 * GoldDto
 * This object contains item gold data.
 * @author Javier
 */
class GoldDto {

    /** @var int */
    public $base;

    /** @var boolean */
    public $purchasable;

    /** @var int */
    public $sell;

    /** @var int */
    public $total;

    public function __construct($d) {
        $this->base = $d->base;
        $this->purchasable = $d->purchasable;
        $this->sell = $d->sell;
        $this->total = $d->total;
    }

}
