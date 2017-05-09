<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LolApi\Exceptions\LolApiGeneralException;

/**
 * DuoQController
 *
 * @author Javier
 * @Route("/lolapi/")
 */
class LolApiController extends Controller {

    /**
     * @Route("", name="lolapi_call")
     */
    public function callmethodAction(Request $request) {

        $lolapi = new \LolApi\LolApi();
        $lolapi->LolApiConfig->region = $request->get('region');
        $lolapi->LolApiConfig->active_cache = true;
        $lolapi->LolApiConfig->active_debug = true;
        $lolapi->LolApiConfig->force_get_cache = $request->get('force_get_cache') == 1 ? true : false;
        $method = $request->get('method');

        $response = new Response();
        try {
            error_reporting(0);
            $data['data'] = call_user_func_array([$lolapi, $method], $request->get('methodParams'));
            if ($lolapi->LolApiConfig->active_debug) {
                $data['debug'] = $lolapi->RequestManager->DebugManager->debug_results;
            }
        } catch (LolApiGeneralException $ex) {
            $data['exception'] = ['message' => $ex->getMessage(), 'code' => $ex->getCode()];
            $response->setStatusCode((int) $ex->getCode());
        }

        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
