<?php

declare(strict_types=1);

namespace App\Repository;

use App\Collection\CategoryPageArticles;
use App\Entity\Article;
use App\Entity\Category;
use App\Exception\UndefinedCategoryException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * Get articles from DB by slug
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getArticleBySlug(string $slug): CategoryPageArticles
    {
        $em = $this->getEntityManager();
        
        $category = $em
            ->getRepository(Category::class)
            ->findBy(['slug' => $slug]);

        if ($category == null) {
            throw new UndefinedCategoryException($slug);
        }

        $articles = $em
            ->getRepository(Article::class)
            ->findBy(['category' => $category[0]->getId()]);

        return new CategoryPageArticles($articles);
    }
}
