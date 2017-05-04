<?php

namespace LolApi\Classes\Match;

/**
 * ParticipantTimeline
 * This object contains all timeline information
 * @author Javier
 */
class ParticipantTimeline {

    #~ lane ~# 
    const LANE_MID = 'MID';
    const LANE_MIDDLE = 'MIDDLE';
    const LANE_TOP = 'TOP';
    const LANE_JUNGLE = 'JUNGLE';
    const LANE_BOT = 'BOT';
    const LANE_BOTTOM = 'BOTTOM';
    #~ role ~#
    const ROLE_DUO = 'DUO';
    const ROLE_NONE = 'NONE';
    const ROLE_SOLO = 'SOLO';
    const ROLE_DUO_CARRY = 'DUO_CARRY';
    const ROLE_DUO_SUPPORT = 'DUO_SUPPORT';

    /**
     * Ancient golem assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $ancientGolemAssistsPerMinCounts;

    /**
     * Ancient golem kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $ancientGolemKillsPerMinCounts;

    /**
     * Assisted lane deaths per minute timeline data
     * @var ParticipantTimelineData
     */
    public $assistedLaneDeathsPerMinDeltas;

    /**
     * Assisted lane kills per minute timeline data
     * @var ParticipantTimelineData
     */
    public $assistedLaneKillsPerMinDeltas;

    /**
     * Baron assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $baronAssistsPerMinCounts;

    /**
     * Baron kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $baronKillsPerMinCounts;

    /**
     * Creeps per minute timeline data
     * @var ParticipantTimelineData
     */
    public $creepsPerMinDeltas;

    /**
     * Creep score difference per minute timeline data
     * @var ParticipantTimelineData
     */
    public $csDiffPerMinDeltas;

    /**
     * Damage taken difference per minute timeline data
     * @var ParticipantTimelineData
     */
    public $damageTakenDiffPerMinDeltas;

    /**
     * Damage taken per minute timeline data
     * @var ParticipantTimelineData
     */
    public $damageTakenPerMinDeltas;

    /**
     * Dragon assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $dragonAssistsPerMinCounts;

    /**
     * Dragon kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $dragonKillsPerMinCounts;

    /**
     * Elder lizard assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $elderLizardAssistsPerMinCounts;

    /**
     * Elder lizard kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $elderLizardKillsPerMinCounts;

    /**
     * Gold per minute timeline data
     * @var ParticipantTimelineData
     */
    public $goldPerMinDeltas;

    /**
     * Inhibitor assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $inhibitorAssistsPerMinCounts;

    /**
     * Inhibitor kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $inhibitorKillsPerMinCounts;

    /**
     * Participant's lane (Legal values: MID, MIDDLE, TOP, JUNGLE, BOT, BOTTOM)
     * @var string
     */
    public $lane;

    /**
     * Participant's role (Legal values: DUO, NONE, SOLO, DUO_CARRY, DUO_SUPPORT)
     * @var string
     */
    public $role;

    /**
     * Tower assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $towerAssistsPerMinCounts;

    /**
     * Tower kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $towerKillsPerMinCounts;

    /**
     * Tower kills per minute timeline data
     * @var ParticipantTimelineData
     */
    public $towerKillsPerMinDeltas;

    /**
     * Vilemaw assists per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $vilemawAssistsPerMinCounts;

    /**
     * Vilemaw kills per minute timeline counts
     * @var ParticipantTimelineData
     */
    public $vilemawKillsPerMinCounts;

    /**
     * Wards placed per minute timeline data
     * @var ParticipantTimelineData
     */
    public $wardsPerMinDeltas;

    /**
     * Experience difference per minute timeline data
     * @var ParticipantTimelineData
     */
    public $xpDiffPerMinDeltas;

    /**
     * Experience per minute timeline data
     * @var ParticipantTimelineData
     */
    public $xpPerMinDeltas;

    function __construct($d) {
        $this->ancientGolemAssistsPerMinCounts = new ParticipantTimelineData($d->ancientGolemAssistsPerMinCounts);
        $this->ancientGolemKillsPerMinCounts = new ParticipantTimelineData($d->ancientGolemKillsPerMinCounts);
        $this->assistedLaneDeathsPerMinDeltas = new ParticipantTimelineData($d->assistedLaneDeathsPerMinDeltas);
        $this->assistedLaneKillsPerMinDeltas = new ParticipantTimelineData($d->assistedLaneKillsPerMinDeltas);
        $this->baronAssistsPerMinCounts = new ParticipantTimelineData($d->baronAssistsPerMinCounts);
        $this->baronKillsPerMinCounts = new ParticipantTimelineData($d->baronKillsPerMinCounts);
        $this->creepsPerMinDeltas = new ParticipantTimelineData($d->creepsPerMinDeltas);
        $this->csDiffPerMinDeltas = new ParticipantTimelineData($d->csDiffPerMinDeltas);
        $this->damageTakenDiffPerMinDeltas = new ParticipantTimelineData($d->damageTakenDiffPerMinDeltas);
        $this->damageTakenPerMinDeltas = new ParticipantTimelineData($d->damageTakenPerMinDeltas);
        $this->dragonAssistsPerMinCounts = new ParticipantTimelineData($d->dragonAssistsPerMinCounts);
        $this->dragonKillsPerMinCounts = new ParticipantTimelineData($d->dragonKillsPerMinCounts);
        $this->elderLizardAssistsPerMinCounts = new ParticipantTimelineData($d->elderLizardAssistsPerMinCounts);
        $this->elderLizardKillsPerMinCounts = new ParticipantTimelineData($d->elderLizardKillsPerMinCounts);
        $this->goldPerMinDeltas = new ParticipantTimelineData($d->goldPerMinDeltas);
        $this->inhibitorAssistsPerMinCounts = new ParticipantTimelineData($d->inhibitorAssistsPerMinCounts);
        $this->inhibitorKillsPerMinCounts = new ParticipantTimelineData($d->inhibitorKillsPerMinCounts);
        $this->lane = $d->lane;
        $this->role = $d->role;
        $this->towerAssistsPerMinCounts = new ParticipantTimelineData($d->towerAssistsPerMinCounts);
        $this->towerKillsPerMinCounts = new ParticipantTimelineData($d->towerKillsPerMinCounts);
        $this->towerKillsPerMinDeltas = new ParticipantTimelineData($d->towerKillsPerMinDeltas);
        $this->vilemawAssistsPerMinCounts = new ParticipantTimelineData($d->vilemawAssistsPerMinCounts);
        $this->vilemawKillsPerMinCounts = new ParticipantTimelineData($d->vilemawKillsPerMinCounts);
        $this->wardsPerMinDeltas = new ParticipantTimelineData($d->wardsPerMinDeltas);
        $this->xpDiffPerMinDeltas = new ParticipantTimelineData($d->xpDiffPerMinDeltas);
        $this->xpPerMinDeltas = new ParticipantTimelineData($d->xpPerMinDeltas);
    }

}
