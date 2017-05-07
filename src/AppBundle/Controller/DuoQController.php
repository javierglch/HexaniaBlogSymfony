<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * DuoQController
 *
 * @author Javier
 * @Route("/duoq/")
 */
class DuoQController extends Controller{
    
    /**
     * @Route("", name="duoq_index")
     */
    public function indexAction(){
        return $this->render('duoq/index.html.twig');
    }
    
}
