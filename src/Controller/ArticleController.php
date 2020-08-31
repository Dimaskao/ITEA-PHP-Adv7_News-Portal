<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ArticlePageProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering /article.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class ArticleController extends AbstractController
{
    private ArticlePageProviderInterface $articleProvider;

    public function __construct(ArticlePageProviderInterface $articleProvider)
    {
        $this->articleProvider = $articleProvider;
    }

    /**
     * @Route("/article", methods={"GET"}, name="article")
     */
    public function article(): Response
    {
        $article = $this->articleProvider->getArticle();

        return $this->render('article/article.html.twig', [
            'article' => $article,
        ]);
    }
}
