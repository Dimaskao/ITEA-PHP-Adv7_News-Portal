<?php

declare(strict_types=1);

namespace App\ViewModel;

/**
 * This class storage information about article.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class ArticlePage
{
    private string $categoryTitle;
    private string $title;
    private \DateTimeImmutable $publicationDate;
    private string $Description;

    public function __construct(
        string $categoryTitle,
        string $title,
        \DateTimeImmutable $publicationDate,
        string $Description
    ) {
        $this->categoryTitle = $categoryTitle;
        $this->title = $title;
        $this->publicationDate = $publicationDate;
        $this->Description = $Description;
    }

    public function getCategoryTitle(): string
    {
        return $this->categoryTitle;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }

    public function getShortDescription(): ?string
    {
        return $this->Description;
    }
}
