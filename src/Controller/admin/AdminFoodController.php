<?php

namespace App\Controller\admin;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

}
