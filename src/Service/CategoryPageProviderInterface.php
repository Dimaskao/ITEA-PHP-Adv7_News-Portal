<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\CategoryPageArticle;

interface CategoryPageProviderInterface
{
    public function getArticleByCategory(string $slug): CategoryPageArticle;
}
