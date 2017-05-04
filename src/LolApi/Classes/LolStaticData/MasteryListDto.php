<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MasteryListDto
 * This object contains mastery list data.
 * @author Javier
 */
class MasteryListDto {

    #~ masteryListData ~#
    const MASTERYLISTDATA_ALL='all';
    const MASTERYLISTDATA_IMAGE='image';
    const MASTERYLISTDATA_MASTERY_TREE='masteryTree';
    const MASTERYLISTDATA_PREREQ='prereq';
    const MASTERYLISTDATA_RANKS='ranks';
    const MASTERYLISTDATA_SANITIZED_DESCRIPTION='sanitizedDescription';
    const MASTERYLISTDATA_TREE='tree';
    
    
    /** @var MasteryDto Map[string, MasteryDto] */
    public $data;

    /** @var MasteryTreeDto */
    public $tree;

    /** @var string */
    public $type;

    /** @var string  */
    public $version;

    public function __construct($d) {
        $this->data = [];
        foreach ($d->data as $key => $o) {
            $this->data[$key] = new MasteryDto($o);
        }
        $this->tree = new MasteryTreeDto($d->tree);
        $this->type = $d->type;
        $this->version = $d->version;
    }

}
