<?php

namespace App\Controller\admin;

use App\Entity\Food;
use App\Form\FoodFormType;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminFoodController extends AbstractController
{
    /**
     * @Route("/admin/food", name="admin_food")
     */
	public function index(FoodRepository $repository): Response
	{
		$food = $repository->findAll();
		return $this->render('admin_food/index.html.twig', [
			'food' => $food,
		]);
	}

	/**
	 * @Route("/admin/food/add", name="admin_food_add")
	 * @Route("/admin/food/{id}/edit", name="admin_food_edit")
	 * Method ("GET", "POST")
	 */
	public function addAndEditFood(Food $food = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
	{
		if(!$food){
			$food = new Food();
		}
		$form = $this->createForm(FoodFormType::class, $food);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
			$uploadedImage = $form->get('uploadedImage')->getData();
			if($uploadedImage){
				$newFileName = uniqid().'.'.$uploadedImage->guessExtension();
				try {
					$uploadedImage->move(
						$this->getParameter('image_directory'),
						$newFileName
					);
				} catch (FileException $e) {}
				$food->setImage($newFileName);
			}
			$manager->persist($food);
			$modif = $food->getId() !== null;
			$this->addFlash('success', ($modif) ? 'La modification a été effectuée' : 'Ajout a été effectué');
			$manager->flush();
			return $this->redirectToRoute('admin_food');
		}
		return $this->render('admin_food/edit_food.html.twig', [
			'food' => $food,
			'form' =>$form->createView(),
			'modification' => $food->getId() !== null
		]);
	}

	/**
	 * @Route("/admin/food/{id}", name="admin_food_delete")
	 * Method ('DELETE')
	 */
	public function deleteFood(Food $food, Request $request, EntityManagerInterface $manager) {
		if($this->isCsrfTokenValid('DEL' . $food->getId(), $request->get('_token'))) {
			$manager->remove($food);
			$manager->flush();
			$this->addFlash('success', 'La suppression a été effectuée');
		}
		return $this->redirectToRoute('admin_food');
	}


}
