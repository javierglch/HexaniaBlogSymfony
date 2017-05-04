<?php

namespace LolApi\Classes\League;

/**
 * LeagueDto
 * This object contains league information.
 * @author Javier
 */
class LeagueDto {
    #~ queue ~#

    const QUEUE_RANKED_FLEX_SR = 'RANKED_FLEX_SR';
    const QUEUE_RANKED_FLEX_TT = 'RANKED_FLEX_TT';
    const QUEUE_RANKED_SOLO_5x5 = 'RANKED_SOLO_5x5';
    const QUEUE_RANKED_TEAM_3x3 = 'RANKED_TEAM_3x3';
    const QUEUE_RANKED_TEAM_5x5 = 'RANKED_TEAM_5x5';

    #~ tier ~#
    const TIER_CHALLENGER = 'CHALLENGER';
    const TIER_MASTER = 'MASTER';
    const TIER_DIAMOND = 'DIAMOND';
    const TIER_PLATINUM = 'PLATINUM';
    const TIER_GOLD = 'GOLD';
    const TIER_SILVER = 'SILVER';
    const TIER_BRONZE = 'BRONZE';

    /**
     * The requested league entries.
     * @var LeagueEntryDto array
     */
    public $entries;

    /**
     * This name is an internal place-holder name only. Display and localization of names in the game client are handled client-side.
     * @var string
     */
    public $name;

    /**
     * Specifies the relevant participant that is a member of this league (i.e., a requested summoner ID, a requested team ID, or the ID of a team to which one of the requested summoners belongs). Only present when full league is requested so that participant's entry can be identified. Not present when individual entry is requested.
     * @var string
     */
    public $participantId;

    /**
     * The league's queue type. (Legal values: RANKED_FLEX_SR, RANKED_FLEX_TT, RANKED_SOLO_5x5, RANKED_TEAM_3x3, RANKED_TEAM_5x5)
     * @var string
     */
    public $queue;

    /**
     * The league's tier. (Legal values: CHALLENGER, MASTER, DIAMOND, PLATINUM, GOLD, SILVER, BRONZE)
     * @var string
     */
    public $tier;

    function __construct($data) {
        $this->entries = [];
        foreach ($data->entries as $o) {
            $this->entries[] = new LeagueEntryDto($o);
        }
        $this->name = $data->name;
        $this->participantId = $data->participantId;
        $this->queue = $data->queue;
        $this->tier = $data->tier;
    }

    
    /**
     * Construye el objeto image tag para devolver la imagen del base_tier
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return \LolApi\ImagesApi\ImageTag
     */
    public function getTierBaseIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->tier_base_icon($this->tier, $imgTitle?$imgTitle:$this->tier, $imgClass, $v, $tooltip);
    }

}
