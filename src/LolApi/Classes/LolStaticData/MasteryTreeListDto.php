<?php

namespace LolApi\Classes\LolStaticData;

/**
 * MasteryTreeListDto
 *
 * @author Javier
 */
class MasteryTreeListDto {
    
    /**
     *
     * @var array List[MasteryTreeItemDto] 
     */
    public $masteryTreeItems;
    
    public function __construct($d) {
        $this->masteryTreeItems = new MasteryTreeItemDto($d->masteryTreeItems);
    }

    
}
