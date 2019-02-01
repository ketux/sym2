<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Todo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Article;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use BlogBundle\Entity\User;
use BlogBundle\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class ToDoController extends Controller
{
		/**
		* @Route("/todos", name="todo_list")
		*/
	 
	 public function listAction (Request $request){
		$todos = $this->getDoctrine()
			->getRepository('BlogBundle:Todo')
			->findAll();
					
		return $this->render('todo/index.html.twig', array (
			'todos' => $todos
		
		));
	 }
	 /**
		* @Route("/todo/create", name="todo_create")
		*/
	 
	 public function createAction (Request $request){
			$todo = new ToDo;
			
			$form = $this->createFormBuilder($todo)
				->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High' ), 'attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('due_date', DateTimeType::class, array('attr' => array('class' => 'formcontrol', 'style'=> 'margin-bottom:15px') ))
				->add('Save', SubmitType::class, array('label' => 'Create ToDo', 'attr' => array('class' => 'btn btn-primary', 'style'=> 'margin-bottom:15px') ))

				->getForm();
				
				$form->handleRequest($request);
				
				if ($form->isSubmitted() && $form->isValid() ) {
					//get data
					$name = $form ['name']->getData();
					$category = $form ['category']->getData();	
					$description = $form ['description']->getData();
					$priority = $form ['priority']->getData();
					$due_date = $form ['due_date']->getData();
					
					$now = new\DateTime('now');
					
					$todo->setName($name);
					$todo->setCategory($category);
					$todo->setDescription($description);
					$todo->setPriority($priority);
					$todo->setDueDate($due_date);
					$todo->setCreateDate($now);
					
					$em = $this->getDoctrine()->getManager();
					
					$em->persist($todo);
					$em->flush();
					
					$this->addFlash(
						'notice',
						'ToDo added'						
					
					);

						return $this->redirectToRoute('todo_list');
					
				}
				
		return $this->render('todo/create.html.twig', array(
			'form' => $form->createView()
		
		));
	 }
	 /**
		* @Route("/todo/edit/{id}", name="todo_edit")
		*/
	 
	 public function editAction ($id, Request $request){
					
		$todo = $this->getDoctrine()
			->getRepository('BlogBundle:Todo')
			->find($id);	

					$now = new\DateTime('now');			
					
					$todo->setName($todo->getname() );
					$todo->setCategory($todo->getcategory() );
					$todo->setDescription($todo->getdescription() );
					$todo->setPriority($todo->getpriority() );
					$todo->setDueDate($todo->getDueDate() );
					$todo->setCreateDate($now);
					
			$form = $this->createFormBuilder($todo)
				->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High' ), 'attr' => array('class' => 'form-control', 'style'=> 'margin-bottom:15px') ))
				->add('due_date', DateTimeType::class, array('attr' => array('class' => 'formcontrol', 'style'=> 'margin-bottom:15px') ))
				->add('Save', SubmitType::class, array('label' => 'Update ToDo', 'attr' => array('class' => 'btn btn-primary', 'style'=> 'margin-bottom:15px') ))

				->getForm();
				
				$form->handleRequest($request);
				
				if ($form->isSubmitted() && $form->isValid() ) {
					//get data
					$name = $form ['name']->getData();
					$category = $form ['category']->getData();	
					$description = $form ['description']->getData();
					$priority = $form ['priority']->getData();
					$due_date = $form ['due_date']->getData();
					
					$now = new\DateTime('now');
					
					$em = $this->getDoctrine()->getManager();
					$todo = $em->getRepository('BlogBundle:ToDo')->find($id);
								
					$todo->setName($name);
					$todo->setCategory($category);
					$todo->setDescription($description);
					$todo->setPriority($priority);
					$todo->setDueDate($due_date);
					$todo->setCreateDate($now);
										
					$em->flush();
					
					$this->addFlash(
						'notice',
						'ToDo updated'						
					);
						return $this->redirectToRoute('todo_list');
					
			}
			
		return $this->render('/todo/edit.html.twig', array (
			'todo' => $todo,
			'form' => $form->createView()
			));
	 }
	 
	 /**
		* @Route("/todo/details/{id}", name="todo_details")
		*/
	 
	 public function detailsAction ($id, Request $request){
					
		$todo = $this->getDoctrine()
			->getRepository('BlogBundle:Todo')
			->find($id);
					
		return $this->render('http://localhost/symfonis/2018.01.15/first_app/web/app_dev.php/todo/details.html.twig', array (
			'todo' => $todo
		
		));
		}
		
		/**
		* @Route("/todo/delete/{id}", name="todo_delete")
		*/
	 
	 public function deleteAction ($id, Request $request){
					
		$em = $this->getDoctrine()->getManager();
		$todo = $em->getRepository('BlogBundle:ToDo')->find($id);
		
		$em->remove($todo);
		$em->flush();
		
		$this->addFlash(
			'notice',
			'ToDo removed'						
			);
		
		return $this->redirectToRoute('todo_list');
		}
		
		
			
}


 