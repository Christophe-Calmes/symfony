<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Auteur = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $CommentaireArticle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textComments = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $valideComments = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?User
    {
        return $this->Auteur;
    }

    public function setAuteur(?User $Auteur): self
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getCommentaireArticle(): ?Articles
    {
        return $this->CommentaireArticle;
    }

    public function setCommentaireArticle(?Articles $CommentaireArticle): self
    {
        $this->CommentaireArticle = $CommentaireArticle;

        return $this;
    }

    public function getTextComments(): ?string
    {
        return $this->textComments;
    }

    public function setTextComments(string $textComments): self
    {
        $this->textComments = $textComments;

        return $this;
    }

    public function getValideComments(): ?int
    {
        return $this->valideComments;
    }

    public function setValideComments(int $valideComments): self
    {
        $this->valideComments = $valideComments;

        return $this;
    }
}
