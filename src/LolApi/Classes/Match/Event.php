<?php

namespace LolApi\Classes\Match;

/**
 * Event
 * This object contains game event information. Note that not all legal type 
 * values documented below are valid for all games. Event data evolves over 
 * time and certain values may be relevant only for older or newer games.
 * @author Javier
 */
class Event {

    //ASCENDEDTYPE
    const ASCENDEDTYPE_CLEAR_ASCENDED = 'CLEAR_ASCENDED';
    const ASCENDEDTYPE_CHAMPION_ASCENDED = 'CHAMPION_ASCENDED';
    const ASCENDEDTYPE_MINION_ASCENDED = 'MINION_ASCENDED';
    //EVENTTYPE
    const EVENTTYPE_ASCENDED_EVENT = 'ASCENDED_EVENT';
    const EVENTTYPE_BUILDING_KILL = 'BUILDING_KILL';
    const EVENTTYPE_CAPTURE_POINT = 'CAPTURE_POINT';
    const EVENTTYPE_CHAMPION_KILL = 'CHAMPION_KILL';
    const EVENTTYPE_ELITE_MONSTER_KILL = 'ELITE_MONSTER_KILL';
    const EVENTTYPE_ITEM_DESTROYED = 'ITEM_DESTROYED';
    const EVENTTYPE_ITEM_PURCHASED = 'ITEM_PURCHASED';
    const EVENTTYPE_ITEM_SOLD = 'ITEM_SOLD';
    const EVENTTYPE_ITEM_UNDO = 'ITEM_UNDO';
    const EVENTTYPE_PORO_KING_SUMMON = 'PORO_KING_SUMMON';
    const EVENTTYPE_SKILL_LEVEL_UP = 'SKILL_LEVEL_UP';
    const EVENTTYPE_WARD_KILL = 'WARD_KILL';
    const EVENTTYPE_WARD_PLACED = 'WARD_PLACED';
    //laneType
    const LANETYPE_BOT_LANE = 'BOT_LANE';
    const LANETYPE_MID_LANE = 'MID_LANE';
    const LANETYPE_TOP_LANE = 'TOP_LANE';
    //levelUpType
    const LEVELUPTYPE_EVOLVE = 'EVOLVE';
    const LEVELUPTYPE_NORMAL = 'NORMAL';
    //monsterType
    const MOSTERTYPE_BARON_NASHOR = 'BARON_NASHOR';
    const MOSTERTYPE_BLUE_GOLEM = 'BLUE_GOLEM';
    const MOSTERTYPE_DRAGON = 'DRAGON';
    const MOSTERTYPE_RED_LIZARD = 'RED_LIZARD';
    const MOSTERTYPE_RIFTHERALD = 'RIFTHERALD';
    const MOSTERTYPE_VILEMAW = 'VILEMAW';
    //pointCaptured
    const POINTCAPTURED_POINT_A = 'POINT_A';
    const POINTCAPTURED_POINT_B = 'POINT_B';
    const POINTCAPTURED_POINT_C = 'POINT_C';
    const POINTCAPTURED_POINT_D = 'POINT_D';
    const POINTCAPTURED_POINT_E = 'POINT_E';
    //towerType
    const TOWERTYPE_BASE_TURRET = 'BASE_TURRET';
    const TOWERTYPE_FOUNTAIN_TURRET = 'FOUNTAIN_TURRET';
    const TOWERTYPE_INNER_TURRET = 'INNER_TURRET';
    const TOWERTYPE_NEXUS_TURRET = 'NEXUS_TURRET';
    const TOWERTYPE_OUTER_TURRET = 'OUTER_TURRET';
    const TOWERTYPE_UNDEFINED_TURRE = 'UNDEFINED_TURRE';
    //wardType
    const WARDTYPE_BLUE_TRINKET = 'BLUE_TRINKET';
    const WARDTYPE_SIGHT_WARD = 'SIGHT_WARD';
    const WARDTYPE_TEEMO_MUSHROOM = 'TEEMO_MUSHROOM';
    const WARDTYPE_UNDEFINED = 'UNDEFINED';
    const WARDTYPE_VISION_WARD = 'VISION_WARD';
    const WARDTYPE_YELLOW_TRINKET = 'YELLOW_TRINKET';
    const WARDTYPE_YELLOW_TRINKET_UPGRADE = 'YELLOW_TRINKET_UPGRADE';

    /**
     * The ascended type of the event. Only present if relevant. Note that CLEAR_ASCENDED refers to when a participants kills the ascended player. (Legal values: CHAMPION_ASCENDED, CLEAR_ASCENDED, MINION_ASCENDED)
     * @var string
     */
    public $ascendedType;

    /**
     * The assisting participant IDs of the event. Only present if relevant.
     * @var array List[int]
     */
    public $assistingParticipantIds;

    /**
     * The building type of the event. Only present if relevant. (Legal values: INHIBITOR_BUILDING, TOWER_BUILDING)
     * @var string
     */
    public $buildingType;

    /**
     * The creator ID of the event. Only present if relevant.
     * @var int
     */
    public $creatorId;

    /**
     * Event type. (Legal values: ASCENDED_EVENT, BUILDING_KILL, CAPTURE_POINT, CHAMPION_KILL, ELITE_MONSTER_KILL, ITEM_DESTROYED, ITEM_PURCHASED, ITEM_SOLD, ITEM_UNDO, PORO_KING_SUMMON, SKILL_LEVEL_UP, WARD_KILL, WARD_PLACED)
     * @var string
     */
    public $eventType;

    /**
     * The ending item ID of the event. Only present if relevant.
     * @var int
     */
    public $itemAfter;

    /**
     * The starting item ID of the event. Only present if relevant.
     * @var int
     */
    public $itemBefore;

    /**
     * The item ID of the event. Only present if relevant.
     * @var int
     */
    public $itemId;

    /**
     * The killer ID of the event. Only present if relevant. Killer ID 0 indicates a minion.
     * @var int
     */
    public $killerId;

    /**
     * The lane type of the event. Only present if relevant. (Legal values: BOT_LANE, MID_LANE, TOP_LANE)
     * @var string
     */
    public $laneType;

    /**
     * The level up type of the event. Only present if relevant. (Legal values: EVOLVE, NORMAL)
     * @var string
     */
    public $levelUpType;

    /**
     * The monster subtype of the event. Only present if relevant.
     * @var string
     */
    public $monsterSubType;

    /**
     * The monster type of the event. Only present if relevant. (Legal values: BARON_NASHOR, BLUE_GOLEM, DRAGON, RED_LIZARD, RIFTHERALD, VILEMAW)
     * @var string
     */
    public $monsterType;

    /**
     * The participant ID of the event. Only present if relevant.
     * @var int
     */
    public $participantId;

    /**
     * The point captured in the event. Only present if relevant. (Legal values: POINT_A, POINT_B, POINT_C, POINT_D, POINT_E)
     * @var string
     */
    public $pointCaptured;

    /**
     * The position of the event. Only present if relevant.
     * @var Position
     */
    public $position;

    /**
     * The skill slot of the event. Only present if relevant.
     * @var int
     */
    public $skillSlot;

    /**
     * The team ID of the event. Only present if relevant.
     * @var int
     */
    public $teamId;

    /**
     * Represents how many milliseconds into the game the event occurred.
     * @var long
     */
    public $timestamp;

    /**
     * The tower type of the event. Only present if relevant. (Legal values: BASE_TURRET, FOUNTAIN_TURRET, INNER_TURRET, NEXUS_TURRET, OUTER_TURRET, UNDEFINED_TURRET)
     * @var string
     */
    public $towerType;

    /**
     * The victim ID of the event. Only present if relevant.
     * @var int
     */
    public $victimId;

    /**
     * The ward type of the event. Only present if relevant. (Legal values: BLUE_TRINKET, SIGHT_WARD, TEEMO_MUSHROOM, UNDEFINED, VISION_WARD, YELLOW_TRINKET, YELLOW_TRINKET_UPGRADE)
     * @var string
     */
    public $wardType;

    function __construct($d) {
        $this->ascendedType = $d->ascendedType;
        $this->assistingParticipantIds = $d->assistingParticipantIds;
        $this->buildingType = $d->buildingType;
        $this->creatorId = $d->creatorId;
        $this->eventType = $d->eventType;
        $this->itemAfter = $d->itemAfter;
        $this->itemBefore = $d->itemBefore;
        $this->itemId = $d->itemId;
        $this->killerId = $d->killerId;
        $this->laneType = $d->laneType;
        $this->levelUpType = $d->levelUpType;
        $this->monsterSubType = $d->monsterSubType;
        $this->monsterType = $d->monsterType;
        $this->participantId = $d->participantId;
        $this->pointCaptured = $d->pointCaptured;
        $this->position = new Position($d->position);
        $this->skillSlot = $d->skillSlot;
        $this->teamId = $d->teamId;
        $this->timestamp = $d->timestamp;
        $this->towerType = $d->towerType;
        $this->victimId = $d->victimId;
        $this->wardType = $d->wardType;
    }

    /** @var \LolApi\Classes\LolStaticData\ItemDto */
    private $ItemAfterItemDto;

    /** @var \LolApi\Classes\LolStaticData\ItemDto */
    private $ItemBeforeItemDto;

    /** @var \LolApi\Classes\LolStaticData\ItemDto */
    private $ItemDto;

    /**
     * Devuelve el objeto ItemDto del item en cuestion. Comprueba que el item contenga una id > 0
     * @param string $itemData Use ItemDto::ITEMDATA_... Tags to return additional data. Only id, name, plaintext, group, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return ItemDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getItemAfterItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->ItemAfterItemDto && $this->itemAfter > 0) {
            $this->ItemAfterItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->itemAfter, $itemData, $locale, $version);
        }
        return $this->ItemAfterItemDto;
    }

    /**
     * Devuelve el objeto ItemDto del item en cuestion. Comprueba que el item contenga una id > 0
     * @param string $itemData Use ItemDto::ITEMDATA_... Tags to return additional data. Only id, name, plaintext, group, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return ItemDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getItemBeforeItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->ItemBeforeItemDto && $this->itemBefore > 0) {
            $this->ItemBeforeItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->itemBefore, $itemData, $locale, $version);
        }
        return $this->ItemBeforeItemDto;
    }

    /**
     * Devuelve el objeto ItemDto del item en cuestion. Comprueba que el item contenga una id > 0
     * @param string $itemData Use ItemDto::ITEMDATA_... Tags to return additional data. Only id, name, plaintext, group, and description are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return ItemDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getItemItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->ItemDto && $this->itemId > 0) {
            $this->ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->itemId, $itemData, $locale, $version);
        }
        return $this->ItemDto;
    }

    /**
     * Devuelve un array de objetos de Participant
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return Participant
     */
    public function getAssistingParticipants(MatchDetail $MatchDetail) {
        $aResult = [];
        foreach ($this->assistingParticipantIds as $participantId) {
            $aResult[] = $MatchDetail->participants[$participantId - 1];
        }
        return $aResult;
    }

    /**
     * Devuelve un array de objetos de ParticipantIdentity
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return ParticipantIdentity array
     */
    public function getAssistingParticipantIdentities(MatchDetail $MatchDetail) {
        $aResult = [];
        foreach ($this->assistingParticipantIds as $participantId) {
            $aResult[] = $MatchDetail->participantIdentities[$participantId - 1];
        }
        return $aResult;
    }

    /**
     * Devuelve el objeto Participant relacionado con la id del killer
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return Participant
     */
    public function getKillerParticipant(MatchDetail $MatchDetail) {
        return $MatchDetail->participants[$this->killerId - 1];
    }

    /**
     * Devuelve el objeto ParticipantIdentity relacionado con la id del killer
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return ParticipantIdentity array
     */
    public function getKillerParticipantIdentity(MatchDetail $MatchDetail) {
        return $MatchDetail->participantIdentities[$this->killerId - 1];
    }

    /**
     * Devuelve el objeto Participant del participante principal del evento
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return Participant
     */
    public function getVictimParticipant(MatchDetail $MatchDetail) {
        return $MatchDetail->participants[$this->victimId - 1];
    }

    /**
     * Devuelve el objeto ParticipantIdentity del participante principal del evento
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return ParticipantIdentity array
     */
    public function getVictimParticipantIdentitie(MatchDetail $MatchDetail) {
        return $MatchDetail->participantIdentities[$this->victimId - 1];
    }

    /**
     * Devuelve el objeto Participant del participante principal del evento
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return Participant
     */
    public function getParticipant(MatchDetail $MatchDetail) {
        return $MatchDetail->participants[$this->participantId - 1];
    }

    /**
     * Devuelve el objeto ParticipantIdentity del participante principal del evento
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return ParticipantIdentity array
     */
    public function getParticipantIdentitie(MatchDetail $MatchDetail) {
        return $MatchDetail->participantIdentities[$this->participantId - 1];
    }

}
