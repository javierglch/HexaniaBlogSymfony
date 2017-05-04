<?php

namespace LolApi\Classes\Match;

/**
 * Participant
 * This object contains match participant information
 * @author Javier
 */
class Participant {

    const HIGHESTACHIEVEDSEASONTIER_CHALLENGER = 'CHALLENGER';
    const HIGHESTACHIEVEDSEASONTIER_MASTER = 'MASTER';
    const HIGHESTACHIEVEDSEASONTIER_DIAMOND = 'DIAMOND';
    const HIGHESTACHIEVEDSEASONTIER_PLATINUM = 'PLATINUM';
    const HIGHESTACHIEVEDSEASONTIER_GOLD = 'GOLD';
    const HIGHESTACHIEVEDSEASONTIER_SILVER = 'SILVER';
    const HIGHESTACHIEVEDSEASONTIER_BRONZE = 'BRONZE';
    const HIGHESTACHIEVEDSEASONTIER_UNRANKED = 'UNRANKED';

    /**
     * Champion ID
     * @var int
     */
    public $championId;

    /**
     * Highest ranked tier achieved for the previous season, if any, otherwise null. Used to display border in game loading screen. (Legal values: CHALLENGER, MASTER, DIAMOND, PLATINUM, GOLD, SILVER, BRONZE, UNRANKED)
     * @var string
     */
    public $highestAchievedSeasonTier;

    /**
     * List of mastery information
     * @var Mastery array List[Mastery]
     */
    public $masteries;

    /**
     * Participant ID
     * @var int
     */
    public $participantId;

    /**
     * List of rune information
     * @var Rune array List[Rune]
     */
    public $runes;

    /**
     * First summoner spell ID
     * @var int
     */
    public $spell1Id;

    /**
     * Second summoner spell ID
     * @var int
     */
    public $spell2Id;

    /**
     * Participant statistics
     * @var ParticipantStats
     */
    public $stats;

    /**
     * Team ID
     * @var int
     */
    public $teamId;

    /**
     * Timeline data. Delta fields refer to values for the specified period (e.g., the gold per minute over the first 10 minutes of the game versus the second 20 minutes of the game. Diffs fields refer to the deltas versus the calculated lane opponent(s). 
     * @var ParticipantTimeline
     */
    public $timeline;

    public function __construct($d) {
        $this->championId = $d->championId;
        $this->highestAchievedSeasonTier = $d->highestAchievedSeasonTier;
        $this->masteries = [];
        foreach ($d->masteries as $o) {
            $this->masteries[] = new Mastery($o);
        }
        $this->participantId = $d->participantId;
        $this->runes = [];
        foreach ($d->runes as $o) {
            $this->runes[] = new Rune($o);
        }
        $this->spell1Id = $d->spell1Id;
        $this->spell2Id = $d->spell2Id;
        $this->stats = new ParticipantStats($d->stats);
        $this->teamId = $d->teamId;
        $this->timeline = new ParticipantTimeline($d->timeline);
    }

    /** @var \LolApi\Classes\LolStaticData\ChampionDto */
    private $StaticChampionDto;
    
    /**
     * Recupera la información de un campeon
     * @param string $champData Usar LolStaticData\ChampionListDto::CHAMPDATA_... para escoger el tag. Tags to return additional data. Only type, version, data, id, key, name, and title are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param string $locale Locale code for returned data (e.g., en_US, es_ES). If not specified, the default locale for the region is used.
     * @param string $version Data dragon version for returned data. If not specified, the latest version for the region is used. List of valid versions can be obtained from the /versions endpoint.
     * @return \LolApi\Classes\LolStaticData\ChampionDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getStaticChampionDto($champData = null, $locale = null, $version = null) {
        if (!$this->StaticChampionDto) {
            $this->StaticChampionDto = \LolApi\LolApi::globalApi()->getStaticChampionDto($this->championId, $champData, $locale, $version);
        }
        return $this->StaticChampionDto;
    }
    
    /**
     * Devuelve el objeto participantIdentity relacionado
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return ParticipantIdentity
     */
    public function getParticipantIdentity(MatchDetail $MatchDetail) {
        return $MatchDetail->participantIdentities[$this->participantId - 1];
    }
    
    /** @var \LolApi\Classes\LolStaticData\SummonerSpellDto */
    private $SummonerSpell_1;
    
    /**
     * Devuelve el hechizo de invocador buscado
     * @param string $spellData Usar SummonerSpellDto::SPELLDATA_... Tags to return additional data. Only id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param boolean $locale If specified as true, the returned data map will use the spells' IDs as the keys. If not specified or specified as false, the returned data map will use the spells' keys instead.
     * @param string $version Tags to return additional data. Only type, version, data, id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @return \LolApi\Classes\LolStaticData\SummonerSpellDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerSpell_1($spellData = null, $locale = null, $version = null) {
        if(!$this->SummonerSpell_1){
            $this->SummonerSpell_1 = \LolApi\LolApi::globalApi()->getSummonerSpellDto($this->spell1Id, $spellData, $locale, $version);
        }
        return $this->SummonerSpell_1;
    }

    /** @var \LolApi\Classes\LolStaticData\SummonerSpellDto */
    private $SummonerSpell_2;
    
    /**
     * Devuelve el hechizo de invocador buscado
     * @param string $spellData Usar SummonerSpellDto::SPELLDATA_... Tags to return additional data. Only id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @param boolean $locale If specified as true, the returned data map will use the spells' IDs as the keys. If not specified or specified as false, the returned data map will use the spells' keys instead.
     * @param string $version Tags to return additional data. Only type, version, data, id, key, name, description, and summonerLevel are returned by default if this parameter isn't specified. To return all additional data, use the tag 'all'.
     * @return SummonerSpellDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerSpell_2($spellData = null, $locale = null, $version = null) {
        if(!$this->SummonerSpell_2){
            $this->SummonerSpell_2 = \LolApi\LolApi::globalApi()->getSummonerSpellDto($this->spell2Id, $spellData, $locale, $version);
        }
        return $this->SummonerSpell_2;
    }
}
