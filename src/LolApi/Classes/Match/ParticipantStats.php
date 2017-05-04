<?php

namespace LolApi\Classes\Match;

/**
 * ParticipantStats
 * This object contains participant statistics information
 * @author Javier
 */
class ParticipantStats {

    /**
     * Number of assists
     * @var long 
     */
    public $assists;

    /**
     * Champion level achieved
     * @var long 
     */
    public $champLevel;

    /**
     * If game was a dominion game, player's combat score, otherwise 0
     * @var long 
     */
    public $combatPlayerScore;

    /**
     * Number of deaths
     * @var long 
     */
    public $deaths;

    /**
     * Number of double kills
     * @var long 
     */
    public $doubleKills;

    /**
     * Flag indicating if participant got an assist on first blood
     * @var boolean 
     */
    public $firstBloodAssist;

    /**
     * Flag indicating if participant got first blood
     * @var boolean 
     */
    public $firstBloodKill;

    /**
     * Flag indicating if participant got an assist on the first inhibitor
     * @var boolean 
     */
    public $firstInhibitorAssist;

    /**
     * Flag indicating if participant destroyed the first inhibitor
     * @var boolean 
     */
    public $firstInhibitorKill;

    /**
     * Flag indicating if participant got an assist on the first tower
     * @var boolean 
     */
    public $firstTowerAssist;

    /**
     * Flag indicating if participant destroyed the first tower
     * @var boolean 
     */
    public $firstTowerKill;

    /**
     * Gold earned
     * @var long 
     */
    public $goldEarned;

    /**
     * Gold spent
     * @var long 
     */
    public $goldSpent;

    /**
     * Number of inhibitor kills
     * @var long 
     */
    public $inhibitorKills;

    /**
     * First item ID
     * @var long 
     */
    public $item0;

    /**
     * Second item ID
     * @var long 
     */
    public $item1;

    /**
     * Third item ID
     * @var long 
     */
    public $item2;

    /**
     * Fourth item ID
     * @var long 
     */
    public $item3;

    /**
     * Fifth item ID
     * @var long 
     */
    public $item4;

    /**
     * Sixth item ID
     * @var long 
     */
    public $item5;

    /**
     * Seventh item ID
     * @var long 
     */
    public $item6;

    /**
     * Number of killing sprees
     * @var long 
     */
    public $killingSprees;

    /**
     * Number of kills
     * @var long 
     */
    public $kills;

    /**
     * Largest critical strike
     * @var long 
     */
    public $largestCriticalStrike;

    /**
     * Largest killing spree
     * @var long 
     */
    public $largestKillingSpree;

    /**
     * Largest multi kill
     * @var long 
     */
    public $largestMultiKill;

    /**
     * Magical damage dealt
     * @var long 
     */
    public $magicDamageDealt;

    /**
     * Magical damage dealt to champions
     * @var long 
     */
    public $magicDamageDealtToChampions;

    /**
     * Magic damage taken
     * @var long 
     */
    public $magicDamageTaken;

    /**
     * Minions killed
     * @var long 
     */
    public $minionsKilled;

    /**
     * Neutral minions killed
     * @var long 
     */
    public $neutralMinionsKilled;

    /**
     * Neutral jungle minions killed in the enemy team's jungle
     * @var long 
     */
    public $neutralMinionsKilledEnemyJungle;

    /**
     * Neutral jungle minions killed in your team's jungle
     * @var long 
     */
    public $neutralMinionsKilledTeamJungle;

    /**
     * If game was a dominion game, number of node captures
     * @var long 
     */
    public $nodeCapture;

    /**
     * If game was a dominion game, number of node capture assists
     * @var long 
     */
    public $nodeCaptureAssist;

    /**
     * If game was a dominion game, number of node neutralizations
     * @var long 
     */
    public $nodeNeutralize;

    /**
     * If game was a dominion game, number of node neutralization assists
     * @var long 
     */
    public $nodeNeutralizeAssist;

    /**
     * If game was a dominion game, player's objectives score, otherwise 0
     * @var long 
     */
    public $objectivePlayerScore;

    /**
     * Number of penta kills
     * @var long 
     */
    public $pentaKills;

    /**
     * Physical damage dealt
     * @var long 
     */
    public $physicalDamageDealt;

    /**
     * Physical damage dealt to champions
     * @var long 
     */
    public $physicalDamageDealtToChampions;

    /**
     * Physical damage taken
     * @var long 
     */
    public $physicalDamageTaken;

    /**
     * Number of quadra kills
     * @var long 
     */
    public $quadraKills;

    /**
     * Sight wards purchased
     * @var long 
     */
    public $sightWardsBoughtInGame;

    /**
     * If game was a dominion game, number of completed team objectives (i.e., quests)
     * @var long 
     */
    public $teamObjective;

    /**
     * Total damage dealt
     * @var long 
     */
    public $totalDamageDealt;

    /**
     * Total damage dealt to champions
     * @var long 
     */
    public $totalDamageDealtToChampions;

    /**
     * Total damage taken
     * @var long 
     */
    public $totalDamageTaken;

    /**
     * Total heal amount
     * @var long 
     */
    public $totalHeal;

    /**
     * If game was a dominion game, player's total score, otherwise 0
     * @var long 
     */
    public $totalPlayerScore;

    /**
     * If game was a dominion game, team rank of the player's total score (e.g., 1-5)
     * @var long 
     */
    public $totalScoreRank;

    /**
     * Total dealt crowd control time
     * @var long 
     */
    public $totalTimeCrowdControlDealt;

    /**
     * Total units healed
     * @var long 
     */
    public $totalUnitsHealed;

    /**
     * Number of tower kills
     * @var long 
     */
    public $towerKills;

    /**
     * Number of triple kills
     * @var long 
     */
    public $tripleKills;

    /**
     * True damage dealt
     * @var long 
     */
    public $trueDamageDealt;

    /**
     * True damage dealt to champions
     * @var long 
     */
    public $trueDamageDealtToChampions;

    /**
     * True damage taken
     * @var long 
     */
    public $trueDamageTaken;

    /**
     * Number of unreal kills
     * @var long 
     */
    public $unrealKills;

    /**
     * Vision wards purchased
     * @var long 
     */
    public $visionWardsBoughtInGame;

    /**
     * Number of wards killed
     * @var long 
     */
    public $wardsKilled;

    /**
     * Number of wards placed
     * @var long 
     */
    public $wardsPlaced;

    /**
     * Flag indicating whether or not the participant won
     * @var boolean 
     */
    public $winner;

    function __construct($d) {
        foreach (get_object_vars($d) as $key => $value) {
            $this->$key = $value;
        }
    }

    
    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item0ItemDto;

    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item1ItemDto;

    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item2ItemDto;

    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item3ItemDto;

    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item4ItemDto;

    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item5ItemDto;

    /** @var LolApi\Classes\LolStaticData\ItemDto */
    private $item6ItemDto;

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
    public function getItem0ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item0ItemDto) {
            $this->item0ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item0, $itemData, $locale, $version);
        }
        return $this->item0ItemDto;
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
    public function getItem1ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item1ItemDto) {
            $this->item1ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item1, $itemData, $locale, $version);
        }
        return $this->item1ItemDto;
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
    public function getItem2ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item2ItemDto) {
            $this->item2ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item2, $itemData, $locale, $version);
        }
        return $this->item2ItemDto;
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
    public function getItem3ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item3ItemDto) {
            $this->item3ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item3, $itemData, $locale, $version);
        }
        return $this->item3ItemDto;
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
    public function getItem4ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item4ItemDto) {
            $this->item4ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item4, $itemData, $locale, $version);
        }
        return $this->item4ItemDto;
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
    public function getItem5ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item5ItemDto) {
            $this->item5ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item5, $itemData, $locale, $version);
        }
        return $this->item5ItemDto;
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
    public function getItem6ItemDto($itemData = null, $locale = null, $version = null) {
        if (!$this->item6ItemDto) {
            $this->item6ItemDto = \LolApi\LolApi::globalApi()->getStaticItemDto($this->item6, $itemData, $locale, $version);
        }
        return $this->item6ItemDto;
    }
    
}
