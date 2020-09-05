<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\PageArticle;

interface PageArticleProviderInterface
{
    public function getArticleById(int $id): PageArticle;
}
