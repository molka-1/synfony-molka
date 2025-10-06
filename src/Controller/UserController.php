<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_index')]
    public function index(UserRepository $userRepository): Response
    {
        // Récupère tous les utilisateurs
        $users = $userRepository->findAll();

        // Rend la page Twig
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
} 