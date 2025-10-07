<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/user/add', name: 'user_add')]
    public function add(EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setName('Molka');
        $user->setAge(22);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User added successfully with ID: ' . $user->getId());
    }

    #[Route('/user/update/{id}', name: 'user_update')]
    public function update(int $id, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id); // ✅ Fixed here

        if (!$user) {
            return new Response('User not found with ID: ' . $id);
        }

        $user->setName('rasslen');
        $user->setAge(30);

        $entityManager->flush();

        return new Response('User updated successfully with ID: ' . $user->getId());
    }

    #[Route('/user/remove/{id}', name: 'user_remove')]
    public function remove(int $id, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            return new Response('User not found with ID: ' . $id);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return new Response('User removed successfully with ID: ' . $id);
    }
}
