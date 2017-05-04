<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MapDataDto
 * This object contains map data.
 * @author Javier
 */
class MapDataDto {

    /** @var MapDetailsDto array Map[string, MapDetailsDto] */
    public $data;

    /** @var string */
    public $type;

    /** @var string */
    public $version;

    public function __construct($d) {
        $this->data = [];
        foreach ($d->data as $key => $o) {
            $this->data[$key] = new MapDetailsDto($o);
        }
        $this->type = $d->type;
        $this->version = $d->version;
    }

}
