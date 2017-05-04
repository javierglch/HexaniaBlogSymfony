<?php

namespace LolApi\Classes\Champion;

/**
 * ChampionListDto
 *
 * @author Javier
 */
class ChampionListDto {

    /**
     * The collection of champion information.
     * @var ChampionDto array 
     */
    public $champions;

    public function __construct($data) {
        $this->champions = [];
        foreach ($data->champions as $ChampionDtoData) {
            $this->champions[] = new ChampionDto($ChampionDtoData);
        }
    }

}
