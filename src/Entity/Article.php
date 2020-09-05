<?php

declare(strict_types=1);

namespace App\Entity;

use App\Excaption\ArticleBodyCannotBeEmptyExcaption;
use App\Repository\ArticleRepository;
use App\ViewModel\HomePageArticle;
use App\ViewModel\PageArticle;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $image = null;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private ?string $shortDescription = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $body = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $publicationDate = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $updatedAt;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getHomePageArticle(): HomePageArticle
    {
        return new HomePageArticle(
            $this->id,
            'set category title', //TODO: set category title
            $this->title,
            $this->publicationDate,
            $this->image,
            $this->shortDescription
        );
    }

    public function getArticleById(): PageArticle
    {
        return new PageArticle(
            $this->id,
            'set category title', //TODO: set category title
            $this->title,
            $this->publicationDate,
            $this->body
        );
    }

    public function addImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function addShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function addBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @throws ArticleBodyCannotBeEmptyExcaption
     */
    public function publish(): void
    {
        if (null === $this->body) {
            throw new ArticleBodyCannotBeEmptyExcaption();
        }

        $this->publicationDate = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

}
