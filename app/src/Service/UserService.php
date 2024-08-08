<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;

class UserService
{
    private $entityManager;
    private $cache;
    private $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        FilesystemAdapter $cache,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->cache = $cache;
    }

    public function addNewOrUpdateUser(Request $request)
    {
        try {
            $userId = $request->request->get('user_id');

            $userData = $request->request->get('firstname') . ' - ' . $request->request->get('lastname') . ' - ' . $request->request->get('address');

            if ($userId) {
                $user = $this->entityManager->getRepository(User::class)->find($userId);
                if ($user) {
                    $user->setData($userData);
                }
            } else {
                $user = new User();
                $user->setData($userData);
                $this->entityManager->persist($user);
            }

            $this->entityManager->flush();
            $this->cache->clear();

            $this->logger->log(LogLevel::INFO, 'Operation Succeeded', [
                'operation' => $userId ? 'update' : 'create',
                'userId' => $userId,
                'userData' => $userData,
            ]);
        } catch (\Exception $e) {
            $this->logger->log(LogLevel::ERROR, 'Operation Failed', [
                'operation' => $userId ? 'update' : 'create',
                'userId' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }

    public function deleteUserById($userId)
    {
        try {
            $user = $this->entityManager->getRepository(User::class)->find($userId);
            if ($user) {
                $this->entityManager->remove($user);
                $this->entityManager->flush();
                $this->cache->clear();;
            }

            $this->logger->log(LogLevel::INFO, 'Operation Succeeded', [
                'operation' => 'delete',
                'userId' => $userId
            ]);
        } catch (\Exception $e) {
            $this->logger->log(LogLevel::ERROR, 'Operation Failed', [
                'operation' => 'delete',
                'userId' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }

    public function getPaginatedUsersTable($page, $limit)
    {
        try {
            $cacheItem = $this->cache->getItem('users_list_' . $page);

            if (!$cacheItem->isHit()) {
                $query = $this->entityManager->createQueryBuilder()
                    ->select('u')
                    ->from(User::class, 'u')
                    ->orderBy('u.id', 'DESC')
                    ->setFirstResult(($page - 1) * $limit)
                    ->setMaxResults($limit)
                    ->getQuery();

                $users = $query->getResult();

                $cacheItem->set($users);
                $cacheItem->expiresAfter(60);
                $this->cache->save($cacheItem);
            }

            $this->logger->log(LogLevel::INFO, 'Operation Succeeded', [
                'operation' => 'pagination'
            ]);

            return $cacheItem->get();
        } catch (\Exception $e) {
            $this->logger->log(LogLevel::ERROR, 'Operation Failed', [
                'operation' => 'pagination',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function getMaxPages($limit)
    {
        $totalUsers = $this->entityManager->createQueryBuilder()
            ->select('count(u.id)')
            ->from(User::class, 'u')
            ->getQuery()
            ->getSingleScalarResult();

        return ceil($totalUsers / $limit);
    }
}
