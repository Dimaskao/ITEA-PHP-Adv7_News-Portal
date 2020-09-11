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
        $qb = $this->createQueryBuilder('c');

        $query = $qb
                ->select('a.id', 'a.title', 'a.image', 'a.publicationDate', 'a.shortDescription')
                ->leftJoin('c.articles', 'a')
                ->where('c.slug = :slug AND a.publicationDate IS NOT NULL')
                ->setParameter('slug', $slug)
                ->getQuery();
        $result = $query->getResult();

        if (empty($result)) {
            throw new UndefinedCategoryException($slug);//TODO write normal
        }

        return $result;
    }
}
