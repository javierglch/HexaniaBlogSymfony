<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * DuoQController
 *
 * @author Javier
 * @Route("/analisis/")
 */
class AnalisisController extends Controller {

    /**
     * @Route("", name="analisis_index")
     */
    public function indexAction() {
        return $this->render('analisis/index.html.twig');
    }

    /**
     * @Route("current-game-v2", name="current_game_analisis_index_v2")
     */
    public function currentGameAnalisisV2(Request $request){
        return $this->render('analisis/current_game_analisis_v2.html.twig', ['champImgVersion'=>@\LolApi\LolApi::globalApi()->getRealmDto()->v]);
    }
    
    /**
     * @Route("current-game", name="current_game_analisis_index")
     */
    public function currentGameAnalisisAction(Request $request) {

        if (!$request->get('summoner_name')) {
            return $this->render('analisis/current_game_analisis.html.twig', ['invocador_buscado'=>null,'current_game_analisis' => null]);
        }

        error_reporting(0);
        set_time_limit(0);

        $lol = new \LolApi\LolApi();
        $lol->LolApiConfig->region = $request->get('region');
        if ($request->get('force_get_cache')) {
            $lol->LolApiConfig->force_get_cache = true;
        }
        $lol->LolApiConfig->active_debug = true;
        $lol->LolApiConfig->active_cache = true;
        $lol->LolApiConfig->enable_throw_errors = false;

        $yo_team_id = 100;
        $aSummoners = [];
        $teamscores = [];
        $teamscores[100] = 0;
        $teamscores[200] = 0;

        try {
            $yo = $lol->getSummonerDtoByName($request->get('summoner_name'));
            $currentgame = $lol->getCurrentGameInfo($yo->id);

            foreach ($currentgame->participants as $key => $participant) {
                $sum_id = $participant->summonerId;

                if ($sum_id == $yo->id) {
                    $yo_team_id = $participant->teamId;
                }

                $champ_id = $participant->championId;

                try {
                    $rankedstats = $lol->getRankedStatsDto($sum_id);

                    $champstats = $rankedstats->getStatsOfChampion($champ_id);

                    $totalchampstats = [
                        'wins' => $champstats->stats->totalSessionsWon ? $champstats->stats->totalSessionsWon : 0,
                        'loses' => $champstats->stats->totalSessionsLost ? $champstats->stats->totalSessionsLost : 0,
                        'totalgames' => $champstats->stats->totalSessionsPlayed ? $champstats->stats->totalSessionsPlayed : 0,
                        'kda' => $champstats->stats->totalDeathsPerSession > 0 ? (($champstats->stats->totalChampionKills + $champstats->stats->totalAssists) / $champstats->stats->totalDeathsPerSession) : (($champstats->stats->totalChampionKills + $champstats->stats->totalAssists) > 0 ? 3 : 0),
                    ];
                } catch (\Exception $ex) {
                    $totalchampstats = [
                        'wins' => 0,
                        'loses' => 0,
                        'totalgames' => 0,
                        'kda' => 0,
                    ];
                }
                $lastgamesresults = [
                    'wins' => 0,
                    'loses' => 0,
                    'totalgames' => 0,
                    'kda' => 0,
                    'totalkda' => 0,
                    'progress' => []
                ];

                $lol->LolApiConfig->enable_throw_errors = false;
                $matchlist = $lol->getMatchList($sum_id, 0, 10, null, null, $champ_id);
                foreach ($matchlist->matches as $key => $match) {
                    $matchdetail = $lol->getMatchDetail($match->matchId,false);
                    $participant_id = null;
                    foreach ($matchdetail->participantIdentities as $key => $pid) {
                        if ($pid->player->summonerId == $sum_id) {
                            $participant_id = $pid->participantId;
                            break;
                        }
                    }
                    $lastgamesresults['wins'] += (float) ($matchdetail->participants[$participant_id - 1]->stats->winner ? 1 : 0);
                    $lastgamesresults['loses'] += (float) ($matchdetail->participants[$participant_id - 1]->stats->winner ? 0 : 1);
                    if ($matchdetail->participants[$participant_id - 1]->stats->deaths > 0) {
                        $lastgamesresults['totalkda'] += (float) ($matchdetail->participants[$participant_id - 1]->stats->kills + $matchdetail->participants[$participant_id - 1]->stats->assists) / $matchdetail->participants[$participant_id - 1]->stats->deaths;
                    } else {
                        $lastgamesresults['totalkda'] += 3;
                    }
                    $lastgamesresults['totalkda'] += (float) ($matchdetail->participants[$participant_id - 1]->stats->deaths > 0 ?: 3);
                    $lastgamesresults['totalgames'] ++;
                }

                $lastmatchlist = $lol->getMatchList($sum_id, 0, 10);
                foreach ($lastmatchlist->matches as $key => $match) {
                    $matchdetail = $match->getMatchDetailDto(false);
                    $participant_id = null;
                    foreach ($matchdetail->participantIdentities as $key => $pid) {
                        if ($pid->player->summonerId == $sum_id) {
                            $participant_id = $pid->participantId;
                            break;
                        }
                    }
                    $lastgamesresults['progress'][] = ($matchdetail->participants[$participant_id - 1]->stats->winner ? 'W' : 'L');
                }

                if ($lastgamesresults['totalgames'] > 0) {
                    $lastgamesresults['kda'] = (float) ($lastgamesresults['totalkda'] / $lastgamesresults['totalgames']);
                } else {
                    $lastgamesresults['kda'] = (float) 0;
                }
                $summoner->totalchampstats = $totalchampstats;
                $summoner->lastgamesresults = $lastgamesresults;
                $summoner->totalscore = 0;

                $summoner->totalscore += (float) ($summoner->totalchampstats['loses'] > 0 ? $summoner->totalchampstats['wins'] / $summoner->totalchampstats['loses'] : $summoner->totalchampstats['wins']);
                $summoner->totalscore += (float) ($summoner->totalchampstats['kda']);
                $summoner->totalscore += (float) ($summoner->lastgamesresults['loses'] > 0 ? $summoner->lastgamesresults['wins'] / $summoner->lastgamesresults['loses'] : $summoner->lastgamesresults['wins']);
                $summoner->totalscore += (float) ($summoner->lastgamesresults['kda']);
                $summoner->champion_image = $lol->getStaticChampionDto($champ_id, \LolApi\Classes\LolStaticData\ChampionListDto::CHAMPDATA_IMAGE)->getChampionSquare_ImageTag();
                $aSummoners[$participant->teamId][] = $summoner;

                $teamscores[$participant->teamId] += $summoner->totalscore;
            }
        } catch (\Exception $ex) {
            $exception = $ex;
        }

        $current_game_analisis = [
            'aSummoners' => $aSummoners,
            'yo_team_id' => $yo_team_id,
            'teamscores' => $teamscores,
            'loldebug' => $lol->RequestManager->DebugManager->printDebug(),
            'exception' => $exception
        ];

        return $this->render('analisis/current_game_analisis.html.twig', ['invocador_buscado'=>$request->get('summoner_name'),'current_game_analisis' => $current_game_analisis]);
    }

}
