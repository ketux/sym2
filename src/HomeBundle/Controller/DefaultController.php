<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_home_route")
     */
    public function indexAction()
    {
        return $this->render('HomeBundle:Default:index.html.twig');
    }
	
	 /**
     * @Route("/contact", name="app_contact_route")
     */
	 public function contactAction()
    {
        return $this->render('HomeBundle:Pages:contact.html.twig');
    }
	
	/**
     * @Route("/greetings/{name}", name="app_greetings_route")
     */
	 public function greetingAction($name)
    {
         return $this->render('HomeBundle:Pages:greetings.html.twig', ['name' => $name]);
	
//kazko neveikia...	
	//	return_new JsonResponse([
	//		'name' => $name,
	//		'luck_number' => rand()
	//	]);
    }
	
}
