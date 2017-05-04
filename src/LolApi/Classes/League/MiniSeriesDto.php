<?php

namespace LolApi\Classes\League;

/**
 * MiniSeriesDto
 * This object contains mini series information.
 * @author Javier
 */
class MiniSeriesDto {

    /**
     * Number of current losses in the mini series.
     * @var int
     */
    public $losses;

    /**
     * String showing the current, sequential mini series progress where 'W' represents a win, 'L' represents a loss, and 'N' represents a game that hasn't been played yet.
     * @var string
     */
    public $progress;

    /**
     * Number of wins required for promotion.
     * @var int
     */
    public $target;

    /**
     * Number of current wins in the mini series.
     * @var int
     */
    public $wins;

    function __construct($data) {
        $this->losses = $data->losses;
        $this->progress = $data->progress;
        $this->target = $data->target;
        $this->wins = $data->wins;
    }

}
