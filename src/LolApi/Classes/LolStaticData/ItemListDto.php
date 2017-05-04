<?php

namespace LolApi\Classes\LolStaticData;

/**
 * ItemListDto
 * This object contains item list data.
 * @author Javier
 */
class ItemListDto {

    const ITEMLISTDATA_ALL = 'all';
    const ITEMLISTDATA_COLLOQ = 'colloq';
    const ITEMLISTDATA_CONSUME_ON_FULL = 'consumeOnFull';
    const ITEMLISTDATA_CONSUMED = 'consumed';
    const ITEMLISTDATA_DEPTH = 'depth';
    const ITEMLISTDATA_EFFECT = 'effect';
    const ITEMLISTDATA_FROM = 'from';
    const ITEMLISTDATA_GOLD = 'gold';
    const ITEMLISTDATA_GROUPS = 'groups';
    const ITEMLISTDATA_HIDE_FROM_ALL = 'hideFromAll';
    const ITEMLISTDATA_IMAGE = 'image';
    const ITEMLISTDATA_IN_STORE = 'inStore';
    const ITEMLISTDATA_INTO = 'into';
    const ITEMLISTDATA_MAPS = 'maps';
    const ITEMLISTDATA_REQUIRED_CHAMPION = 'requiredChampion';
    const ITEMLISTDATA_SANITIZED_DESCRIPTION = 'sanitizedDescription';
    const ITEMLISTDATA_SPECIAL_RECIPE = 'specialRecipe';
    const ITEMLISTDATA_STACKS = 'stacks';
    const ITEMLISTDATA_STATS = 'stats';
    const ITEMLISTDATA_TAGS = 'tags';
    const ITEMLISTDATA_TREE = 'tree';

    /**
     * 
     * @var BasicDataDto
     */
    public $basic;

    /**
     * 
     * @var ItemDto array
     */
    public $data;

    /**
     * 
     * @var GroupDto array
     */
    public $groups;

    /**
     * 
     * @var ItemTreeDto array
     */
    public $tree;

    /**
     * 
     * @var string
     */
    public $type;

    /**
     * 
     * @var string
     */
    public $version;

    function __construct($data) {
        $this->basic = new BasicDataDto($data->basic);
        $this->data = [];
        foreach ($data->data as $o) {
            $this->data[] = new ItemDto($o);
        }
        $this->groups = [];
        foreach ($data->groups as $o) {
            $this->groups[] = new GroupDto($o);
        }
        $this->tree = [];
        foreach ($data->tree as $o) {
            $this->tree[] = new ItemTreeDto($o);
        }
        $this->type = $data->type;
        $this->version = $data->version;
    }

}
