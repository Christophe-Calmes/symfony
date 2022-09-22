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
    public function AllArticles(ArticlesRepository $articlesRepository): Response
    {
      // Récupérer les titres des articles
        $AllArticles = $articlesRepository->findAll();

        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController', 'Allarticles' => $AllArticles
        ]);
    }
    #[Route('/OneArticles/{idArticle}', name: 'app_OneArticle')]
    public function OneArticle(ArticlesRepository $OneArticle, $idArticle): Response
    {
      // Récupérer un article
        $detailArticle = $OneArticle->find($idArticle);
        return $this->render('articles/OneArticle.html.twig', [
            'controller_name' => 'ArticlesController', 'detailArticle' => $detailArticle
        ]);
    }
}
