<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\CategoryPageArticles;

interface CategoryPageProviderInterface
{
    public function getArticleByCategory(string $slug): CategoryPageArticles;
}
