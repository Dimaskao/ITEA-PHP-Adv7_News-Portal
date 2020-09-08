<?php


namespace App\Service;


interface CategoryPageProviderInterface
{
    public function getArticleByCategory(string $slug);
}