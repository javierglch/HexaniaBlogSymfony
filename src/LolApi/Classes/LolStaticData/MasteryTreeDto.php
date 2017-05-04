<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MasteryTreeDto
 * This object contains mastery tree data.
 * @author Javier
 */
class MasteryTreeDto {

    /** @var array List[MasteryTreeListDto] */
    public $Cunning;

    /** @var array List[MasteryTreeListDto] */
    public $Ferocity;

    /** @var array List[MasteryTreeListDto] */
    public $Resolve;

    public function __construct($d) {
        $this->Cunning = [];
        foreach ($d->Cunning as $o) {
            $this->Cunning[] = new MasteryTreeListDto($o);
        }
        $this->Ferocity = [];
        foreach ($d->Ferocity as $o) {
            $this->Ferocity[] = new MasteryTreeListDto($o);
        }
        $this->Resolve = [];
        foreach ($d->Resolve as $o) {
            $this->Resolve[] = new MasteryTreeListDto($o);
        }
    }

}
