<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\UndefinedCategoryException;
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
     * @Route("/category/{slug}", requirements={"slug"="\w+"}, methods={"GET"}, name="app_article_by_category")
     */
    public function showArticleByCategory(string $slug): Response
    {
        try {
            $publishedArticles = $this->categoryProvider->getArticleByCategory($slug);
        } catch (UndefinedCategoryException $e) {
            throw $this->createNotFoundException($e->getMessage(), $e);
        }

        if (empty($publishedArticles->getArticles())) {
            return $this->render('category/show.html.twig', [
                'emptyCategory' => \sprintf('Articles for category "%s" not found.', $slug),
            ]);
        }

        return $this->render('category/show.html.twig', [
           'articles' => $publishedArticles,
        ]);
    }
}
