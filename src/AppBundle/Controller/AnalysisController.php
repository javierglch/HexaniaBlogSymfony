<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * DuoQController
 *
 * @author Javier
 * @Route("/analysis/")
 */
class AnalysisController extends Controller {

    /**
     * @Route("", name="analisis_index")
     */
    public function indexAction() {
        return $this->render('analisis/index.html.twig');
    }

    /**
     * @Route("current-game", name="current_game_analysis")
     */
    public function currentGameAnalysisAction(Request $request){
        return $this->render('analisis/current_game_analysis.html.twig', ['champImgVersion'=>@\LolApi\LolApi::globalApi()->getRealmDto()->v]);
    }
    
    /**
     * @Route("match-list", name="match_list_analysis")
     */
    public function matchListAnalysisAction(Request $request){
        return $this->render('analisis/match_list_analysis.html.twig', ['champImgVersion'=>@\LolApi\LolApi::globalApi()->getRealmDto()->v]);
    }
   
}
