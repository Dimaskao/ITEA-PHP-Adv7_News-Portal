<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends AbstractFixture
{
    private const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $category) {
            $cat = new Category();
            $cat->setName($category);
            $manager->persist($cat);
        }
        $manager->flush();
    }
}
