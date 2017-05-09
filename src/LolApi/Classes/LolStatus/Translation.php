<?php

namespace LolApi\Classes\LolStatus;

/**
 * Translation
 *
 * @author Javier
 */
class Translation {
    
    /** @var string */
    public $locale;
    /** @var string */
    public $content;
    /** @var string */
    public $updated_at;
    
    function __construct($d) {
        $this->locale=$d->locale;
        $this->content=$d->content;
        $this->updated_at=$d->updated_at;
    }

}
