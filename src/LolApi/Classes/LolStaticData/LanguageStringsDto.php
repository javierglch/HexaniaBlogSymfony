<?php

namespace LolApi\Classes\LolStaticData;

/**
 * LanguageStringsDto
 * This object contains language strings data.
 * @author Javier
 */
class LanguageStringsDto {

    /** @var array Map[string,string] */
    public $data;

    /** @var string */
    public $type;

    /** @var string */
    public $version;

    public function __construct($d) {
        $this->data = $d->data;
        $this->type = $d->type;
        $this->version = $d->version;
    }

}
