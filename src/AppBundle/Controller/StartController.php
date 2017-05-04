<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class StartController extends Controller {

	//
	//@Route("/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1}, name="blog_home")
	//Route("/{id}")
	//@Method({"GET", "POST"})
	//@ParamConverter("post", class="SensioBlogBundle:Post")
	//@ParamConverter(converter="name")
	//@ParamConverter("post", class="SensioBlogBundle:Post", options={"id" = "post_id"})	
	//@ParamConverter("post", class="SensioBlogBundle:Post", options={"entity_manager" = "foo"})
	//@ParamConverter("comment", class="SensioBlogBundle:Comment", options={"id" = "comment_id"})
	//@ParamConverter("post", options={"mapping": {"date": "date", "slug": "slug"}})
    //@ParamConverter("comment", options={"mapping": {"comment_slug": "slug"}})
	//@Route("/blog/{date}/{slug}")
	//@ParamConverter("post", options={"exclude": {"date"}})
	//@ParamConverter("post", class="SensioBlogBundle:Post", options={"repository_method" = "findWithJoins"})
	//@ParamConverter("user", class="AcmeBlogBundle:User", options={
	//   "repository_method" = "findByFullName",
	//   "mapping": {"first_name": "firstName", "last_name": "lastName"},
	//   "map_method_signature" = true
	// })
	//@Security("has_role('ROLE_ADMIN')")
	//@Security("is_granted('POST_SHOW', post)")
	//@Security("is_granted('POST_SHOW', post) and has_role('ROLE_ADMIN')")
	//
	public function exampleAction(Request $request, $id) {
		return $this->render('index.html.twig', ['var' => 'hola mundo!']); 
	}
	
	/**
	 * @Route("/", name="start_index")
	 */
	public function indexAction(Request $request) {
		return $this->render('index.html.twig', ['var' => 'hola mundo!']);
	}

}
