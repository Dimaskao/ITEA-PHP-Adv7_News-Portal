<?php

declare(strict_types=1);

namespace App\Repository;

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

    public function getArticleBySlug(string $slug): array
    {
        $isCategoryExist = $this->createQueryBuilder('c')
            ->where('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ;

        if (null === $isCategoryExist->getOneOrNullResult()) {
            throw new UndefinedCategoryException($slug);
        }

        $query = $this->createQueryBuilder('c')
            ->addSelect('a')
            ->leftJoin('c.articles', 'a')
            ->where('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->andWhere('a.publicationDate IS NOT NULL')
            ->getQuery()
        ;

        $category = $query->getOneOrNullResult();

        if (null === $category) {
            return [];
        }

        return $category->getArticles()->toArray(0);
    }
}
