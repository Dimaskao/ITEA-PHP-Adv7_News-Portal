<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\ArticlePage;
use Faker\Factory;
use Faker\Generator;

/**
 * This class generates fake article.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class ArticlePageFakeProvider implements ArticlePageProviderInterface
{
    private const ARTICLE_ID = 1;
    private const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];


    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getArticle(): ArticlePage
    {
        return $this->createArticle(self::ARTICLE_ID);
    }

    private function createArticle(int $id): ArticlePage
    {
        $title = $this->faker->words(
            $this->faker->numberBetween(1, 4),
            true
        );
        $title = \ucfirst($title);

        return new ArticlePage(
            $this->faker->randomElement(self::CATEGORIES),
            $title,
            \DateTimeImmutable::createFromMutable($this->faker->dateTimeThisYear),
            $this->faker->words(
                $this->faker->numberBetween(20, 30),
                true
            )
        );
    }
}
