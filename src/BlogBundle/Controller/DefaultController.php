<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Article;

use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
	/**
     * @Route("/create_article", name="create_article_route")
     */
	 public function createArticleRouteAction (){
		$article = new Article();
		$article->setTitle('Learn Symfony 3');
		$article->setDescription('Mokaus intensyviai');
		$article->setContent('Welcome to symfony');

		$em = $this->getDoctrine()->getManager();
		$em->persist($article);
		$em->flush();
		
		return new Response("Saved new article with id = ". $article->getId());
	 }
	 
	/**
	* @Route("/show_article/{idArticle}", name="show_article_route")
	*/
	
	public function showArticleAction ($idArticle){
		$em = $this->getDoctrine()->getManager();
		$articleRepository = $em->getRepository('BlogBundle:Article');
		$article = $articleRepository->find($idArticle);
		
		if (is_null($article)) {
			return $this->createNotFoundException('No article found for id: ' . $idArticle);
		}
			return $this->render('BlogBundle:Default:article.html.twig', ['$article' => $article]);
	}
}


 