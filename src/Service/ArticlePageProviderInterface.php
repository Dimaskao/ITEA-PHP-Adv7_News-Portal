<?php

declare(strict_types=1);

namespace App\Service;

interface ArticlePageProviderInterface
{
    public function getArticle(): object;
}
