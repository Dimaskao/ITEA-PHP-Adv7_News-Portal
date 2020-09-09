<?php

declare(strict_types=1);

namespace App\Collection;

/**
 * This class storage information about articles for Category Page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class CategoryPageArticles
{
    private array $articles;

    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}
