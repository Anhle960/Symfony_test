<?php

// src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LoginController extends AbstractController
{
    private $logger;
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        try {
            $this->logger->info('ABC');
            if ($this->getUser()) {
                return $this->redirectToRoute('app_user');
            }

            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();

            $this->logger->log(LogLevel::INFO, 'Operation Succeeded', [
                'operation' => 'login'
            ]);

            return $this->render('login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]);
        } catch (\Exception $e) {
            $this->logger->log(LogLevel::ERROR, 'Operation Failed', [
                'operation' => 'login',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }
}
