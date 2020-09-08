<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Exception\NotFoundArticlesForCategoryException;
use App\Service\CategoryPageProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering /category.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class CategoryController extends AbstractController
{
    private CategoryPageProviderInterface $categoryProvider;

    public function __construct(CategoryPageProviderInterface $categoryProvider)
    {
        $this->categoryProvider = $categoryProvider;
    }

    /**
     * @Route("/category/{slug}", methods={"GET"}, name="app_article_by_category")
     */
    public function showArticleByCategory(string $slug): Response
    {
        $publishedArticles = $this->categoryProvider->getArticleByCategory($slug);
        if (empty($publishedArticles->getArticles())) {
            throw new NotFoundArticlesForCategoryException($slug);
        }

        return $this->render('category/show.html.twig', [
           'articles' => $publishedArticles,
        ]);
    }
}
