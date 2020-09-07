<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", methods={"GET"}, name="app_article_by_category")
     */
    public function showArticleByCategory(string $slug): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(['slug' => $slug]);
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category[0]->getId()]);

        foreach ($articles as $a) {
            if (null !== $a->getPublicationDate()) {
                $publishedArticles[] = $a;
            }
        }

        return $this->render('category/show.html.twig', [
           'articles' => $publishedArticles,
        ]);
    }
}
