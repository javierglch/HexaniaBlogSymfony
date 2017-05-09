<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of AdminController
 *
 * @author Javier
 * @Route("/admin/")
 */
class AdminController extends Controller{
    /**
     * 
     * @Route("", name="admin_index")
     */
    public function indexAction(){
        return $this->render();
    }
}
