<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
			$f1 = new Food();
			$f1->setName('Apple')
				 ->setPrice(3)
				 ->setImage('apple.jpeg')
				 ->setCalories(80)
				 ->setProtein(2)
				 ->setFat(1);
			$manager->persist($f1);

			$f2 = new Food();
			$f2->setName('Potato')
				->setPrice(2)
				->setImage('potato.jpeg')
				->setCalories(300)
				->setProtein(10)
				->setFat(1);
			$manager->persist($f2);

			$f3 = new Food();
			$f3->setName('Tomato')
				->setPrice(3)
				->setImage('tomato.jpeg')
				->setCalories(40)
				->setProtein(1)
				->setFat(1);
			$manager->persist($f3);

			$f4 = new Food();
			$f4->setName('Pear')
				->setPrice(6)
				->setImage('pear.jpeg')
				->setCalories(70)
				->setProtein(3)
				->setFat(3);
			$manager->persist($f4);

			$f5 = new Food();
			$f5->setName('Cherry')
				->setPrice(8)
				->setImage('cherry.jpeg')
				->setCalories(150)
				->setProtein(6)
				->setFat(2);
			$manager->persist($f5);

			$f6 = new Food();
			$f6->setName('Salade')
				->setPrice(1)
				->setImage('salade.jpeg')
				->setCalories(10)
				->setProtein(0)
				->setFat(0);
			$manager->persist($f6);

			$f7 = new Food();
			$f7->setName('Carrot')
				->setPrice(2)
				->setImage('carrot.jpeg')
				->setCalories(100)
				->setProtein(1)
				->setFat(1);
			$manager->persist($f7);

			$f8 = new Food();
			$f8->setName('Peach')
				->setPrice(9)
				->setImage('peach.jpeg')
				->setCalories(120)
				->setProtein(5)
				->setFat(3);
			$manager->persist($f8);

			$f9 = new Food();
			$f9->setName('Eggplant')
				->setPrice(6)
				->setImage('eggplant.jpeg')
				->setCalories(200)
				->setProtein(8)
				->setFat(7);
			$manager->persist($f9);

			$f10 = new Food();
			$f10->setName('Strawberry')
				->setPrice(13)
				->setImage('strawberry.jpeg')
				->setCalories(300)
				->setProtein(4)
				->setFat(0);
			$manager->persist($f10);

			$manager->flush();
    }
}
