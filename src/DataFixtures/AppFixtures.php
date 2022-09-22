<?php
// Original
namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// Ajout de User
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Controller\SecurityController;
// Ajout Articles
use App\Repository\UserRepository;
use App\Entity\Articles;
use App\Entity\Comments;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;


class AppFixtures extends Fixture
{
  public function __construct (
    private UserPasswordHasherInterface $hasher,
    private UserRepository $AllUser)
  {
    // private UserPasswordHasherInterface $hasher,
  }
    public function load(ObjectManager $manager): void
    {
      // Création de 20 compte user,
      // 2 à 5 articles par compte et 5 à 8 commentaires par article.
      // Paramètres :
      $userFake = 'chris';
      $clearPassWord = '404';
      $arrayRole = ['ROLE_USER', 'ROLE_ADMIN'];
        // Ajout d'utilisateur + Articles + Commentaires
          for ($i=0; $i < 20 ; $i++) {
              $User = new User();
              $User->setUserName($userFake.$i);
              $User->setEmail('fake'.$i.'@gmail.com');
              $User->setPassword($this->hasher->hashPassword($User, $clearPassWord));
              // setRoles attent un tableau donc array($tableau)
              $User->setRoles(array($arrayRole[0]));
              for ($k=0; $k <rand(2, 5) ; $k++) {
                    $addArticle = new Articles;
                    $createdat = new DateTimeImmutable();
                    $addArticle->setUser($User);
                    $addArticle->setTitreArticle('Titre article'.$i);
                    // Définition des paramètres des articles.
                    $texteArticle = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    In casus belli civi pacem para bellum.';
                      for ($j=0; $j < rand(5,8) ; $j++) {
                        $texteArticle = $texteArticle.$texteArticle;
                      }
                    $addArticle->setTextArticle($texteArticle);
                    // Vidage de la string texteArticle à la fin de la boucle.
                    $texteArticle = '';
                    $addArticle->setLikeArticle(rand(10,900));
                    $addArticle->setDateArticle($createdat);
                    $addArticle->setValideArticle(1);
                    $manager->persist($addArticle);
                      for ($l=0; $l <3 ; $l++) {
                          $addCommentaire = new Comments();
                          $addCommentaire->setAuteur($User);
                          $addCommentaire->setCommentaireArticle($addArticle);
                          $addCommentaire->setTextComments('Un commentaire sous cette article');
                          $addCommentaire->setValideComments(1);
                          $manager->persist($addCommentaire);
                      }
                  }
                $manager->persist($User);
                // dd($manager);
              $manager->flush();
          }
    }
}
