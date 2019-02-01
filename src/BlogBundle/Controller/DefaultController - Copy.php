<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
	/**
     * @Route("/blog_url")
     */
    public function indexAction()
    {
		$articles = [
			[
				'title' => "<script> alert('nu labas');</script>",
				'autor' => 'Jonas',
				'date' => '2017-01-01'
			],
			[
				'title' => 'Title',
				'autor' => 'Jonas',
				'date' => '2017-01-01'
			],
			[
				'title' => 'Title',
				'autor' => 'Jonas',
				'date' => '2017-01-01'

			]
		];
        return $this->render('BlogBundle:Default:index.html.twig', ['articles' => $articles]);
    }
}
 