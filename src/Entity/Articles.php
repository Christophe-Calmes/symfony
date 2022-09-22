<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?User $User = null;

    #[ORM\Column(length: 50)]
    private ?string $TitreArticle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $TextArticle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateArticle = null;

    #[ORM\Column]
    private ?int $LikeArticle = null;

    #[ORM\OneToMany(mappedBy: 'CommentaireArticle', targetEntity: Comments::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ValideArticle = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getTitreArticle(): ?string
    {
        return $this->TitreArticle;
    }

    public function setTitreArticle(string $TitreArticle): self
    {
        $this->TitreArticle = $TitreArticle;

        return $this;
    }

    public function getTextArticle(): ?string
    {
        return $this->TextArticle;
    }

    public function setTextArticle(string $TextArticle): self
    {
        $this->TextArticle = $TextArticle;

        return $this;
    }

    public function getDateArticle(): ?\DateTimeInterface
    {
        return $this->dateArticle;
    }

    public function setDateArticle(\DateTimeInterface $dateArticle): self
    {
        $this->dateArticle = $dateArticle;

        return $this;
    }

    public function getLikeArticle(): ?int
    {
        return $this->LikeArticle;
    }

    public function setLikeArticle(int $LikeArticle): self
    {
        $this->LikeArticle = $LikeArticle;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCommentaireArticle($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommentaireArticle() === $this) {
                $comment->setCommentaireArticle(null);
            }
        }

        return $this;
    }

    public function getValideArticle(): ?int
    {
        return $this->ValideArticle;
    }

    public function setValideArticle(int $ValideArticle): self
    {
        $this->ValideArticle = $ValideArticle;

        return $this;
    }

}
