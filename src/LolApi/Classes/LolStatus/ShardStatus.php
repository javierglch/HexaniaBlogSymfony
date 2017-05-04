<?php

namespace LolApi\Classes\LolStatus;

/**
 * Description of ShardStatus
 *
 * @author Javier
 */
class ShardStatus {

    #~ shard ~#
    const SHARD_NA = 'na';
    const SHARD_BR = 'br';
    const SHARD_LAN = 'lan';
    const SHARD_LAS = 'las';
    const SHARD_OCE = 'oce';
    const SHARD_EUNE = 'eune';
    const SHARD_TR = 'tr';
    const SHARD_RU = 'ru';
    const SHARD_EUW = 'euw';
    const SHARD_KR = 'kr';

    /**
     * 
     * @var string
     */
    public $hostname;

    /**
     * 
     * @var List[string]
     */
    public $locales;

    /**
     * 
     * @var string
     */
    public $name;

    /**
     * 
     * @var string
     */
    public $region_tag;

    /**
     * 
     * @var Service array List[Service]
     */
    public $services;

    /**
     * 
     * @var string
     */
    public $slug;

    public function __construct($d) {
        $this->hostname = $d->hostname;
        $this->locales = $d->locales;
        $this->name = $d->name;
        $this->region_tag = $d->region_tag;
        $this->services = [];
        foreach ($d->services as $o) {
            $this->services[] = new Service($o);
        }
        $this->slug = $d->slug;
    }

}
