<?php


namespace App\ViewModel;

/**
 * This class storage information about articles for Category Page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class CategoryPageArticle
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