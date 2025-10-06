<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/author/details/{name}/{age}', name: 'app_author_details')]
    public function showAuthorDetails(string $name, int $age): Response
    {
        $books = ['Book A', 'Book B', 'Book C'];

        return $this->render('author/details.html.twig', [
            'name' => $name,
            'age' => $age,
            'books' => $books,
        ]);
    }
    // src/Controller/AuthorController.php
#[Route('/author/show/{name}', name: 'app_author_show')]
public function showAuthor(string $name): Response
{
    return $this->render('author/show.html.twig', [
        'name' => $name,
    ]);
}
#[Route('/authors', name: 'app_authors')]
public function listAuthors(): Response
{
  $authors = [
    ['id' => 0, 'picture' => 'images/V.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
    ['id' => 1, 'picture' => 'images/W.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
    ['id' => 2, 'picture' => 'images/T.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
];
    $totalBooks = 0;
    foreach ($authors as $author) {
        $totalBooks += $author['nb_books'];
    }

    return $this->render('author/list.html.twig', [
        'authors' => $authors,
        'totalBooks' => $totalBooks,
    ]);
}
#[Route('/author/showAuthor/{id}', name: 'app_author_details_by_id')]
public function authorDetails(int $id): Response
{
    // Liste des auteurs (même que dans listAuthors)
  $authors = [
    ['id' => 0, 'picture' => 'images/V.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
    ['id' => 1, 'picture' => 'images/W.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
    ['id' => 2, 'picture' => 'images/T.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
];
    // Vérifier que l'auteur existe
    if (!isset($authors[$id])) {
        throw $this->createNotFoundException('Auteur non trouvé');
    }

    $author = $authors[$id];

    return $this->render('author/showAuthor.html.twig', [
        'author' => $author,
    ]);
}


}