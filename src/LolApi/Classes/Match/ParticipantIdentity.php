<?php

namespace LolApi\Classes\Match;

/**
 * ParticipantIdentity
 * This object contains participant identity information
 * @author Javier
 */
class ParticipantIdentity {

    /**
     * Participant ID
     * @var int
     */
    public $participantId;

    /**
     * Player information
     * @var Player
     */
    public $player;

    public function __construct($d) {
        $this->participantId = $d->participantId;
        $this->player = new Player($d->player);
    }

    /** @var \LolApi\Classes\Summoner\SummonerDto */
    private $SummonerDto;

    /**
     * Devuelve el invocador
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
            $this->SummonerDto = \LolApi\LolApi::globalApi()->getSummonerDtoById($this->player->summonerId);
        }
        return $this->SummonerDto;
    }

    /**
     * Devuelve el objeto del particianpante
     * @param \LolApi\Classes\Match\MatchDetail $MatchDetail Se require que se 
     * pase el match detail para poder devolver al participante correspondiente.
     * @return Participant
     */
    public function getParticipant(MatchDetail $MatchDetail) {
        return $MatchDetail->participants[$this->participantId - 1];
    }

}
