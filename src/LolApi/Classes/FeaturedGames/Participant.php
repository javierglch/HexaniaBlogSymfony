<?php

namespace LolApi\Classes\FeaturedGames;

/**
 * CurrentGameParticipant
 *
 * @author Javier
 */
class Participant {

    /**
     * 	Flag indicating whether or not this participant is a bot
     * @var boolean
     */
    public $bot;

    /**
     * 	The ID of the champion played by this participant
     * @var long
     */
    public $championId;

    /**
     * 	The ID of the profile icon used by this participant
     * @var long
     */
    public $profileIconId;

    /**
     * The ID of the first summoner spell used by this participant
     * @var long
     */
    public $spell1Id;

    /**
     * The ID of the second summoner spell used by this participant
     * @var long
     */
    public $spell2Id;

    /**
     * 	The summoner name of this participant
     * @var string
     */
    public $summonerName;

    /**
     * The team ID of this participant, indicating the participant's team
     * @var long
     */
    public $teamId;

    public function __construct($data) {
        $this->bot = $data->bot;
        $this->championId = $data->championId;
        $this->profileIconId = $data->profileIconId;
        $this->spell1Id = $data->spell1Id;
        $this->spell2Id = $data->spell2Id;
        $this->summonerName = $data->summonerName;
        $this->teamId = $data->teamId;
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

    /** @var \LolApi\Classes\Summoner\SummonerDto */
    private $SummonerDto;

    /**
     * Devuelve los invocadodres buscandolos por id
     * @return \LolApi\Classes\Summoner\SummonerDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getSummonerDto() {
        if (!$this->SummonerDto) {
            $this->SummonerDto = \LolApi\LolApi::globalApi()->getSummonerDtoByName($this->summonerName);
        }
        return $this->SummonerDto;
    }

    /**
     * Recupera la imagen del profile icon
     * @param string $imgTitle
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return \LolApi\ImagesApi\ImageTag
     */
    public function getProfileIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->profile_icon($this->profileIconId, $imgTitle ? $imgTitle : $this->summonerName, $imgClass, $v, $tooltip);
    }

    /** @var \LolApi\Classes\LolStaticData\SummonerSpellDto */
    private $SummonerSpell_1;

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
    public function getSummonerSpell_1($spellData = null, $locale = null, $version = null) {
        if (!$this->SummonerSpell_1) {
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
        if (!$this->SummonerSpell_2) {
            $this->SummonerSpell_2 = \LolApi\LolApi::globalApi()->getSummonerSpellDto($this->spell2Id, $spellData, $locale, $version);
        }
        return $this->SummonerSpell_2;
    }

}
