<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ArticleRepository;
use App\ViewModel\PageArticle;

/**
 * Returns article by id.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class PageArticleProvider implements PageArticleProviderInterface
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getArticleById(int $id): PageArticle
    {
        $article = $this->articleRepository->getArticleById($id);

        return $article->getArticleById();
    }
}
