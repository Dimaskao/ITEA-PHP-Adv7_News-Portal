<?php


namespace App\Service;

use App\Repository\ArticleRepository;
use App\ViewModel\PageArticle;

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