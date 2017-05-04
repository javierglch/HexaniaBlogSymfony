<?php

namespace LolApi\Classes\Game;

/**
 * RawStatsDto
 * This object contains raw stat information.
 * @author Javier
 */
class RawStatsDto {

    public $assists;
    public $barracksKilled;
    public $bountyLevel;
    public $championsKilled;
    public $combatPlayerScore;
    public $consumablesPurchased;
    public $damageDealtPlayer;
    public $doubleKills;
    public $firstBlood;
    public $gold;
    public $goldEarned;
    public $goldSpent;
    public $item0;
    public $item1;
    public $item2;
    public $item3;
    public $item4;
    public $item5;
    public $item6;
    public $itemsPurchased;
    public $killingSprees;
    public $largestCriticalStrike;
    public $largestKillingSpree;
    public $largestMultiKill;
    public $legendaryItemsCreated;
    public $level;
    public $magicDamageDealtPlayer;
    public $magicDamageDealtToChampions;
    public $magicDamageTaken;
    public $minionsDenied;
    public $minionsKilled;
    public $neutralMinionsKilled;
    public $neutralMinionsKilledEnemyJungle;
    public $neutralMinionsKilledYourJungle;
    public $nexusKilled;
    public $nodeCapture;
    public $nodeCaptureAssist;
    public $nodeNeutralize;
    public $nodeNeutralizeAssist;
    public $numDeaths;
    public $numItemsBought;
    public $objectivePlayerScore;
    public $pentaKills;
    public $physicalDamageDealtPlayer;
    public $physicalDamageDealtToChampions;
    public $physicalDamageTaken;
    public $playerPosition;
    public $playerRole;
    public $playerScore0;
    public $playerScore1;
    public $playerScore2;
    public $playerScore3;
    public $playerScore4;
    public $playerScore5;
    public $playerScore6;
    public $playerScore7;
    public $playerScore8;
    public $playerScore9;
    public $quadraKills;
    public $sightWardsBought;
    public $spell1Cast;
    public $spell2Cast;
    public $spell3Cast;
    public $spell4Cast;
    public $summonSpell1Cast;
    public $summonSpell2Cast;
    public $superMonsterKilled;
    public $team;
    public $teamObjective;
    public $timePlayed;
    public $totalDamageDealt;
    public $totalDamageDealtToBuildings;
    public $totalDamageDealtToChampions;
    public $totalDamageTaken;
    public $totalHeal;
    public $totalPlayerScore;
    public $totalScoreRank;
    public $totalTimeCrowdControlDealt;
    public $totalUnitsHealed;
    public $tripleKills;
    public $trueDamageDealtPlayer;
    public $trueDamageDealtToChampions;
    public $trueDamageTaken;
    public $turretsKilled;
    public $unrealKills;
    public $victoryPointTotal;
    public $visionWardsBought;
    public $wardKilled;
    public $wardPlaced;
    public $win;

    public function __construct($data) {
        foreach (get_object_vars($data) as $key => $value) {
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
