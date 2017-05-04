<?php

namespace LolApi\Classes\LolStatus;

/**
 * Shard
 *
 * @author Javier
 */
class Shard {

    /**
     * @var string
     */
    public $hostname;

    /**
     * @var array List[string]
     */
    public $locales;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $region_tag;

    /**
     * @var string
     */
    public $slug;

    public function __construct($d) {
        $this->hostname = $d->hostname;
        $this->locales = $d->locales;
        $this->name = $d->name;
        $this->region_tag = $d->region_tag;
        $this->slug = $d->slug;
    }

}
