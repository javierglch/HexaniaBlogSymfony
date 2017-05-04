<?php

namespace LolApi\Classes\LolStaticData;

/**
 * RealmDto
 * This object contains realm data.
 * @author Javier
 */
class RealmDto {

    /**
     * The base CDN url. 
     * @var string 
     */
    public $cdn;

    /**
     * Latest changed version of Dragon Magic's css file. 
     * @var string 
     */
    public $css;

    /**
     * Latest changed version of Dragon Magic. 
     * @var string 
     */
    public $dd;

    /**
     * Default language for this realm. 
     * @var string 
     */
    public $l;

    /**
     * Legacy script mode for IE6 or older. 
     * @var string 
     */
    public $lg;

    /**
     * Latest changed version for each data type listed. 
     * @var stdClass
     */
    public $n;

    /**
     * Special behavior number identifying the largest profileicon id that can be used under 500. Any profileicon that is requested between this number and 500 should be mapped to 0. 
     * @var int 
     */
    public $profileiconmax;

    /**
     * Additional api data drawn from other sources that may be related to data dragon functionality.
     *  @var string 
     */
    public $store;

    /**
     * Current version of this file for this realm. 
     * @var string 
     */
    public $v;

    public function __construct($d) {
        $this->cdn = $d->cdn;
        $this->css = $d->css;
        $this->dd = $d->dd;
        $this->l = $d->l;
        $this->lg = $d->lg;
        $this->n = $d->n;
        $this->profileiconmax = $d->profileiconmax;
        $this->store = $d->store;
        $this->v = $d->v;
    }
    
}
