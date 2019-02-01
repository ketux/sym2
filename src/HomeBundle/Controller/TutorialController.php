<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class TutorialController extends Controller
{

 /**
     * @Route("/tutorial/{name}", name="app_tutorial_route")
     */
	 public function tutorialAction($name)
    {
		if ($name == "python"){
			//old method
			//return $this->redirect($this->generateUrl('app_home_route'));

			//new method
			//return $this->redirectToRoute('app_home_route');
			return $this->forward('HomeBundle:Default:index');
		}
        return new Response ($name);
    }
	
	
	/**
     * @Route("/delete/{name}", name="app_delete_tutorial_route")
     */
	 public function deleteTutorialAction(Request $request, $name)
    {
		$by = $request->query->get('by');
		
		if ($by != 'admin'){
			return $this->redirectToRoute('app_home_route');

		}
        return new Response ($name . ' is deleted');
    }
	
	/**
     * @Route("/write_session", name="app_write_session_route")
     */
	 public function writeSessionAction(Request $request)
    {
		//$this->get('session');
		//$request->getSession();
		
		$this->get('session')->set("shopping_cart",[
			[	
				'item 1' => 'playstation 4',
				'quantity' => '2',
				'price' => '999€'
			],
			[	
				'item 2' => 'Xbox',
				'quantity' => '5',
				'price' => '899€'
			]
		]);
		
		return new Response ('Done');
    } 
	
	/**
     * @Route("/read_session", name="app_read_session_route")
     */
	 public function readSessionAction(Request $request)
    {	//$this->get('session');
		//$request->getSession();
		
		$shopping_cart = $this->get('session')->get('shopping_cart');
		var_dump($shopping_cart); // print_r($shopping_cart);
		die();
        return new Response ();
    }
	
}
