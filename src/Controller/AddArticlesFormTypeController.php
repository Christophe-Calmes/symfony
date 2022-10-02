<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Utilisation du addArticle Form
use App\Form\AddArticlesFormType;

class AddArticlesFormTypeController extends AbstractController
{
    #[Route('/add/articles/form/type', name: 'app_add_articles_form_type')]
    public function addArticle(): Response
    {
        $addArticle = new buildForm();
        $addArticle->setTitreArticle();
        $addArticle->setTextArticle();
        $addArticle->setdateArticle();
        $addArticle->setLikeArticle(0);
        $addArticle->setValideArticle(1);
        $addArticle->setUser('Chris0');
        $formArticle = $this->buildForm();

        return $this->render('add_articles_form_type/index.html.twig', [
            'controller_name' => 'AddArticlesFormTypeController'
        ]);
    }
}
