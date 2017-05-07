<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * DuoQController
 *
 * @author Javier
 * @Route("/flexq/")
 */
class FlexQController extends Controller{
    
    /**
     * @Route("", name="flexq_index")
     */
    public function indexAction(){
        return $this->render('flexq/index.html.twig');
    }
    
}
