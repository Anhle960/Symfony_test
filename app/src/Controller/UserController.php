<?php

namespace App\Controller;

use Doctrine\DBAL\DriverManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $logger;
    private $userService;


    public function __construct(
        UserService $userService,
        LoggerInterface $logger
    ) {
        $this->userService = $userService;
        $this->logger = $logger;
    }

    #[Route('/user', name: 'app_user')]
    public function request(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $action = $request->get("action");

            if ($action === 'delete') {
                $id = $request->query->get('id');
                $this->userService->deleteUserById($id);
            }
        } else if ($request->getMethod() == "POST") {
            $this->userService->addNewOrUpdateUser($request);
        }

        $limit = 10;
        $page = $request->query->getInt('page', 1);
        $users = $this->userService->getPaginatedUsersTable($page, $limit);

        return $this->render('user.html.twig', [
            'obj' => $request->getMethod(),
            'users' => $users,
            'currentPage' => $page,
            'maxPages' => $this->userService->getMaxPages($limit),
        ]);
    }

    private function getConnection()
    {
        $connectionParams = [
            'dbname' => 'symfony',
            'user' => 'symfony',
            'password' => '',
            'host' => 'mariadb',
            'driver' => 'pdo_mysql',
        ];
        return DriverManager::getConnection($connectionParams);
    }

    private function executeRequest($sql, $connection)
    {
        $stmt = $connection->prepare($sql);
        return $stmt->executeQuery()->fetchAllAssociative();
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        // trigger Symfony's logout process
        $this->container->get('security.token_storage')->setToken(null);

        $session = $this->container->get('session');
        $session->invalidate();


        return $this->redirectToRoute('app_login');
    }
}
