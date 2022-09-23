<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticlesRepository;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticlesRepository $lastArticle): Response
    {
      //  Model : findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
      //  $singleArticle = $lastArticle->getLastArticle();

      // Truc qui marche de type Autoroute => Symfony
      $singleArticle = $lastArticle->findBy(array(),array('id'=>'DESC'),1);
        //dd($singleArticle);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 'Article' => $singleArticle
        ]);
    }
}
