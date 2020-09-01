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
    private const ARTICLES_COUNT = 1;
    private const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];

    private object $article;

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getArticle(): object
    {
        for ($i = 0; $i < self::ARTICLES_COUNT; ++$i) {
            $this->article = $this->createArticle($i + 1);
        }

        return $this->article;
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
