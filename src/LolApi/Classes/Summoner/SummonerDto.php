<?php

namespace LolApi\Classes\Summoner;

/**
 * SummonerDto
 * This object contains summoner information.
 * @author Javier
 */
class SummonerDto {

    /**
     * Summoner ID.
     * @var long
     */
    public $id;

    /**
     * Summoner name.
     * @var string
     */
    public $name;

    /**
     * ID of the summoner icon associated with the summoner.
     * @var int
     */
    public $profileIconId;

    /**
     * Date summoner was last modified specified as epoch milliseconds. The following events will update this timestamp: profile icon change, playing the tutorial or advanced tutorial, finishing a game, summoner name change
     * @var long
     */
    public $revisionDate;

    /**
     * Summoner level associated with the summoner.
     * @var long
     */
    public $summonerLevel;

    public function __construct($d) {
        $this->id = $d->id;
        $this->name = $d->name;
        $this->profileIconId = $d->profileIconId;
        $this->revisionDate = $d->revisionDate;
        $this->summonerLevel = $d->summonerLevel;
    }
    
    /**
     * Recupera la imagen del profile icon
     * @param string $imgTitle default = $this->name
     * @param string $imgClass
     * @param string $v
     * @param string $tooltip
     * @return \LolApi\ImagesApi\ImageTag
     */
    public function getProfileIcon_ImageTag($imgTitle = null, $imgClass = null, $v = null, $tooltip = null) {
        return \LolApi\LolApi::globalApi()->ImagesApi->profile_icon($this->profileIconId, $imgTitle ? $imgTitle : $this->name, $imgClass, $v, $tooltip);
    }

    /** @var LolApi\Classes\ChampionMastery\ChampionMasteryDTO */
    private $ChampionMasteryDTO;

    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param long $championId Champion ID to retrieve Champion Mastery for
     * @return \LolApi\Classes\ChampionMastery\ChampionMasteryDTO
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     */
    public function getChampionMasteryDTO($championId) {
        if ($this->ChampionMasteryDTO===null) {
            $this->ChampionMasteryDTO = \LolApi\LolApi::globalApi()->getChampionMasteryDTO($this->id, $championId);
        }
        return $this->ChampionMasteryDTO;
    }

    /** @var ChampionMasteryDTO array */
    private $ChampionMasteryDTOList;

    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @return \LolApi\Classes\ChampionMastery\ChampionMasteryDTO array
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     */
    public function getChampionMasteryDTOList() {
        if ($this->ChampionMasteryDTOList===null) {
            $this->ChampionMasteryDTOList = \LolApi\LolApi::globalApi()->getChampionMasteryDTOList($this->id);
        }
        return $this->ChampionMasteryDTOList;
    }

    /** @var int */
    private $ChampionMasteryScore;

    /**
     * Get Total score of Champion Mastery
     * @return int
     */
    public function getChampionMasteryScore() {
        if ($this->ChampionMasteryScore===null) {
            $this->ChampionMasteryScore = \LolApi\LolApi::globalApi()->getChampionMasteryScore($this->id);
        }
        return $this->ChampionMasteryScore;
    }

    /** @var ChampionMasteryDTO array */
    private $ChampionMasteryTopChampions;

    /**
     * Get a champion mastery by player id and champion id. Response code 204 means
     * there were no masteries found for given player id or player id and champion id combination. (RPC)
     * @param int $count Number of entries to retrieve, defaults to 3
     * @return \LolApi\Classes\ChampionMastery\ChampionMasteryDTO array
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\InternalServerErrorException
     */
    public function getChampionMasteryTopChampions($count = null) {
        if ($this->ChampionMasteryTopChampions===null) {
            $this->ChampionMasteryTopChampions = \LolApi\LolApi::globalApi()->getChampionMasteryTopChampions($this->id, $count);
        }
        return $this->ChampionMasteryTopChampions;
    }

    /** @var LolApi\Classes\CurrentGame\CurrentGameInfo */
    private $CurrentGameInfo;

    /**
     * Recupera el current game
     * @return \LolApi\Classes\CurrentGame\CurrentGameInfo
     * @throws Exceptions\ForbiddenException
     * @throws Exceptions\RateLimitExceededException
     */
    public function getCurrentGameInfo() {
        if ($this->CurrentGameInfo===null) {
            $this->CurrentGameInfo = \LolApi\LolApi::globalApi()->getCurrentGameInfo($this->id);
        }
        return $this->CurrentGameInfo;
    }

    /** @var \LolApi\Classes\Game\RecentGamesDto */
    private $RecentGamesDto;

    /**
     * Recupera las ultimas 10 partidas del invocador
     * @return \LolApi\Classes\Game\RecentGamesDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRecentGamesDto() {
        if ($this->RecentGamesDto===null) {
            $this->RecentGamesDto = \LolApi\LolApi::globalApi()->getRecentGamesDto($this->id);
        }
        return $this->RecentGamesDto;
    }

    /** @var \LolApi\Classes\League\LeagueDto array */
    private $LeagueDtoList;

    /**
     * Recupera las ligas en las que se encuentran los invocadores dados
     * @return \LolApi\Classes\League\LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLeagueDtoList() {
        if ($this->LeagueDtoList===null) {
            $this->LeagueDtoList = \LolApi\LolApi::globalApi()->getLeagueDtoList([$this->id])[$this->id];
        }
        return $this->LeagueDtoList;
    }

    /** @var \LolApi\Classes\League\LeagueDto */
    private $LeagueDtoEnry;

    /**
     * Recupera las entradas de los invocadores en las ligas en las que se encuentran
     * @return \LolApi\Classes\League\LeagueDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getLeagueDtoListEnry() {
        if ($this->LeagueDtoEnry===null) {
            $this->LeagueDtoEnry = \LolApi\LolApi::globalApi()->getLeagueDtoListEnry([$this->id])[$this->id];
        }
        return $this->LeagueDtoEnry;
    }

    /** @var LolApi\Classes\MatchList\MatchList */
    private $MatchList;

    /**
     * Recupera las partidas ranked del invocador dado<br>
     * +Info: A number of optional parameters are provided for filtering. It is up to the caller to ensure that the combination of filter parameters provided is valid for the requested summoner, otherwise, no matches may be returned. If either of the beginTime or endTime parameters is set, they must both be set, although there is no maximum limit on their range. If the beginTime parameter is specified on its own, endTime is assumed to be the current time. If the endTime parameter is specified on its own, beginTime is assumed to be the start of the summoner's match history.
     * @param int $beginIndex The begin index to use for fetching games.
     * @param int $endIndex The end index to use for fetching games.
     * @param string $beginTime The begin time to use for fetching games specified as epoch milliseconds.
     * @param string $endTime The end time to use for fetching games specified as epoch milliseconds.
     * @param array $championIds List of champion IDs to use for fetching games.
     * @param array $rankedQueues Usar MatchList::RANKEDQUEUE_... List of ranked queue types to use for fetching games. Non-ranked queue types will be ignored.
     * @param array $seasons Usar MatchList::SEASON_... List of seasons to use for fetching games.
     * @return \LolApi\Classes\MatchList\MatchList
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMatchList($beginIndex = null, $endIndex = null, $beginTime = null, $endTime = null, $championIds = null, $rankedQueues = null, $seasons = null) {
        if ($this->MatchList===null) {
            $this->MatchList = \LolApi\LolApi::globalApi()->getMatchList($this->id, $beginIndex, $endIndex, $beginTime, $endTime, $championIds, $rankedQueues, $seasons);
        }
        return $this->MatchList;
    }

    /** @var \LolApi\Classes\Stats\RankedStatsDto */
    private $RankedStatsDto;

    /**
     * Develve las estadisticas ranked
     * Includes ranked stats for Twisted Treeline and Summoner's Rift.
     * @param string $season Usar RankedStatsDto::SEASON_... If specified, stats for the given season are returned. Otherwise, stats for the current season are returned.
     * @return \LolApi\Classes\Stats\RankedStatsDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRankedStatsDto($season = null) {
        if ($this->RankedStatsDto===null) {
            $this->RankedStatsDto = \LolApi\LolApi::globalApi()->getRankedStatsDto($this->id, $season);
        }
        return $this->RankedStatsDto;
    }

    /** @var LolApi\Classes\Stats\PlayerStatsSummaryListDto */
    private $PlayerStatsSummaryListDto;

    /**
     * Develve las estadisticas ranked
     * One summary is returned per queue type.
     * @param string $season Usar PlayerStatsSummaryListDto::SEASON_... If specified, stats for the given season are returned. Otherwise, stats for the current season are returned.
     * @return \LolApi\Classes\Stats\PlayerStatsSummaryListDto
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getPlayerStatsSummaryListDto($season = null) {
        if ($this->PlayerStatsSummaryListDto===null) {
            $this->PlayerStatsSummaryListDto = \LolApi\LolApi::globalApi()->getPlayerStatsSummaryListDto($this->id, $season);
        }
        return $this->PlayerStatsSummaryListDto;
    }

    /** @var MasteryPagesDto */
    private $MasteryPagesDto;

    /**
     * Devuelve las páginas de maestrias de los invocadores buscandos
     * @return MasteryPagesDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getMasteryPagesDto() {
        if ($this->MasteryPagesDto===null) {
            $this->MasteryPagesDto = \LolApi\LolApi::globalApi()->getMasteryPagesDto([$this->id]);
        }
        return $this->MasteryPagesDto;
    }

    /** @var RunePagesDto */
    private $RunePagesDto;

    /**
     * Devuelve las páginas de maestrias de los invocadores buscandos
     * @return RunePagesDto Map[string, SummonerDto]
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\InternalServerErrorException
     * @throws Exceptions\ServiceUnavailableException
     */
    public function getRunePagesDto() {
        if ($this->RunePagesDto===null) {
            $this->RunePagesDto = \LolApi\LolApi::globalApi()->getRunePagesDto([$this->id]);
        }
        return $this->RunePagesDto;
    }
    

    /**
     * setChampionMasteryDTO
     * @param \LolApi\Classes\Summoner\LolApi\Classes\ChampionMastery\ChampionMasteryDTO $ChampionMasteryDTO
     * @return $this
     */
    public function setChampionMasteryDTO(LolApi\Classes\ChampionMastery\ChampionMasteryDTO $ChampionMasteryDTO) {
        $this->ChampionMasteryDTO = $ChampionMasteryDTO;
        return $this;
    }

    /**
     * setChampionMasteryDTOList
     * @param \LolApi\Classes\Summoner\ChampionMasteryDTO $ChampionMasteryDTOList
     * @return $this
     */
    public function setChampionMasteryDTOList(ChampionMasteryDTO $ChampionMasteryDTOList) {
        $this->ChampionMasteryDTOList = $ChampionMasteryDTOList;
        return $this;
    }

    /**
     * setChampionMasteryScore
     * @param type $ChampionMasteryScore
     * @return $this
     */
    public function setChampionMasteryScore($ChampionMasteryScore) {
        $this->ChampionMasteryScore = $ChampionMasteryScore;
        return $this;
    }

    /**
     * setChampionMasteryTopChampions
     * @param \LolApi\Classes\Summoner\ChampionMasteryDTO $ChampionMasteryTopChampions
     * @return $this
     */
    public function setChampionMasteryTopChampions(ChampionMasteryDTO $ChampionMasteryTopChampions) {
        $this->ChampionMasteryTopChampions = $ChampionMasteryTopChampions;
        return $this;
    }

    /**
     * setCurrentGameInfo
     * @param \LolApi\Classes\Summoner\LolApi\Classes\CurrentGame\CurrentGameInfo $CurrentGameInfo
     * @return $this
     */
    public function setCurrentGameInfo(LolApi\Classes\CurrentGame\CurrentGameInfo $CurrentGameInfo) {
        $this->CurrentGameInfo = $CurrentGameInfo;
        return $this;
    }

    /**
     * setRecentGamesDto
     * @param \LolApi\Classes\Game\RecentGamesDto $RecentGamesDto
     * @return $this
     */
    public function setRecentGamesDto(\LolApi\Classes\Game\RecentGamesDto $RecentGamesDto) {
        $this->RecentGamesDto = $RecentGamesDto;
        return $this;
    }

    /**
     * setLeagueDtoList
     * @param \LolApi\Classes\League\LeagueDto $LeagueDtoList
     * @return $this
     */
    public function setLeagueDtoList(\LolApi\Classes\League\LeagueDto $LeagueDtoList) {
        $this->LeagueDtoList = $LeagueDtoList;
        return $this;
    }

    /**
     * setLeagueDtoEnry
     * @param \LolApi\Classes\League\LeagueDto $LeagueDtoEnry
     * @return $this
     */
    public function setLeagueDtoEnry(\LolApi\Classes\League\LeagueDto $LeagueDtoEnry) {
        $this->LeagueDtoEnry = $LeagueDtoEnry;
        return $this;
    }

    /**
     * setMatchList
     * @param \LolApi\Classes\Summoner\LolApi\Classes\MatchList\MatchList $MatchList
     * @return $this
     */
    public function setMatchList(LolApi\Classes\MatchList\MatchList $MatchList) {
        $this->MatchList = $MatchList;
        return $this;
    }

    /**
     * setRankedStatsDto
     * @param \LolApi\Classes\Stats\RankedStatsDto $RankedStatsDto
     * @return $this
     */
    public function setRankedStatsDto(\LolApi\Classes\Stats\RankedStatsDto $RankedStatsDto) {
        $this->RankedStatsDto = $RankedStatsDto;
        return $this;
    }

    /**
     * setPlayerStatsSummaryListDto
     * @param \LolApi\Classes\Summoner\LolApi\Classes\Stats\PlayerStatsSummaryListDto $PlayerStatsSummaryListDto
     * @return $this
     */
    public function setPlayerStatsSummaryListDto(LolApi\Classes\Stats\PlayerStatsSummaryListDto $PlayerStatsSummaryListDto) {
        $this->PlayerStatsSummaryListDto = $PlayerStatsSummaryListDto;
        return $this;
    }

    /**
     * setMasteryPagesDto
     * @param \LolApi\Classes\Summoner\MasteryPagesDto $MasteryPagesDto
     * @return $this
     */
    public function setMasteryPagesDto(MasteryPagesDto $MasteryPagesDto) {
        $this->MasteryPagesDto = $MasteryPagesDto;
        return $this;
    }

    /**
     * setRunePagesDto
     * @param \LolApi\Classes\Summoner\RunePagesDto $RunePagesDto
     * @return $this
     */
    public function setRunePagesDto(RunePagesDto $RunePagesDto) {
        $this->RunePagesDto = $RunePagesDto;
        return $this;
    }


    
}
