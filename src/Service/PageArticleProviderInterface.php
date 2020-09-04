<?php

declare(strict_types=1);

namespace App\Service;

interface PageArticleProviderInterface
{
    public function getArticle(int $id): object;
}
