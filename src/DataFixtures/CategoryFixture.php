<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixture extends AbstractFixture
{
    private const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $category) {
            $cat = new Category($category);
            $this->addReference('category_'.$key, $cat);
            $manager->persist($cat);
        }

        $manager->flush();
    }
}
