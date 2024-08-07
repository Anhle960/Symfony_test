<?php

// src/Controller/RegisterController.php
namespace App\Controller;

use App\Entity\Auth;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $authUser = new Auth();
            $authUser->setEmail($request->request->get('email'));
            $authUser->setPassword(
                $userPasswordHasher->hashPassword(
                    $authUser,
                    $request->request->get('password')
                )
            );

            $entityManager->persist($authUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register.html.twig');
    }
}
