<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder): Response
    {
				$user = new User();
				$form = $this->createForm(InscriptionType::class, $user);
				$form->handleRequest($request);
				if($form->isSubmitted() && $form->isValid()) {
					$passwordCrypted = $encoder->hashPassword($user, $user->getPassword());
					$user->setPassword($passwordCrypted);
					$manager->persist($user);
					$manager->flush();
				}
        return $this->render('admin_security/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/login", name="connexion")
	 */
	public function login(AuthenticationUtils $authenticationUtils) {
		return $this->render('admin_security/login.html.twig', [
			'lastUserName' => $authenticationUtils->getLastUsername(),
			'error' => $authenticationUtils->getLastAuthenticationError(),
		]);
	}

	/**
	 * @Route("/logout", name="logout")
	 */
	public function logout() {}
}
