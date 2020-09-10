<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\CategoryPageArticles;
use App\Repository\CategoryRepository;

/**
 * Returns only published articles.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class CategoryPageProvider implements CategoryPageProviderInterface
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getArticleByCategory(string $slug): CategoryPageArticles
    {
        $articles = $this->categoryRepository->getArticleBySlug($slug);

        return new CategoryPageArticles($this->returnOnlyPublishedArticles($articles));
    }

    public function returnOnlyPublishedArticles($articles)
    {
        $publishedArticles = [];

        foreach ($articles->getArticles() as $a) {
            if (null !== $a->getPublicationDate()) {
                $publishedArticles[] = $a;
            }
        }

        return $publishedArticles;
    }
}