<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Utilisation de l'entity Articles
use App\Repository\ArticlesRepository;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticlesRepository $articlesRepository): Response
    {
      // Récupérer les titres des articles
        $AllArticles = $articlesRepository->findAll();

        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController', 'Allarticles' => $AllArticles
        ]);
    }
}
