<?php

namespace LolApi\Classes\LolStaticData;

/**
 * RecommendedDto
 * This object contains champion recommended data.
 * @author Javier
 */
class RecommendedDto {

    /**
     * 
     * @var BlockDto array
     */
    public $blocks;

    /**
     * 
     * @var string
     */
    public $champion;

    /**
     * 
     * @var string
     */
    public $map;

    /**
     * 
     * @var string
     */
    public $mode;

    /**
     * 
     * @var boolean
     */
    public $priority;

    /**
     * 
     * @var string
     */
    public $title;

    /**
     * 
     * @var string
     */
    public $type;

    function __construct($data) {
        $this->blocks = [];
        foreach ($data->blocks as $o) {
            $this->blocks[] = new BlockDto($o);
        }
        $this->champion = $data->champion;
        $this->map = $data->map;
        $this->mode = $data->mode;
        $this->priority = $data->priority;
        $this->title = $data->title;
        $this->type = $data->type;
    }

}
