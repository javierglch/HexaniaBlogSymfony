<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of BlogController
 *
 * @author Javier
 * @Route("/blog/")
 */
class BlogController extends Controller {

    /**
     * @Route("", name="blog_index")
     */
    public function indexAction() {
        //Get the enity manager
        $em = $this->getDoctrine()->getManager();
        //Get the user with name admin
        $user = $em->getRepository("AppBundle\Entity\User")->findOneBy(Array("username" => "javier"));
        //Set the admin role
        //a:2:{i:0;s:10:"ROLE_ADMIN";i:1;s:16:"ROLE_SUPER_ADMIN";}
        $user->removeRole("ROLE_ADMIN");
        //Save it to the database
        $em->persist($user);
        $em->flush();

        return $this->render('blog/index.html.twig');
    }

}
