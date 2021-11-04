<?php

namespace App\Controller;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/food", name="food")
     */
    public function index(FoodRepository $repository): Response
    {
				$food = $repository->findAll();
        return $this->render('food/food.html.twig', [
            'food' => $food,
        ]);
    }

	/**
	 * @Route("/food/{id}", name="show_food")
	 */
	public function displayFood(Food $element): Response
	{
		return $this->render('food/element.html.twig', [
			'element' => $element,
		]);
	}
}
