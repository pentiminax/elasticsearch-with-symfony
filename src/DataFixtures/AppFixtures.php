<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\CourseFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 100; $i++) {
            CategoryFactory::createOne();
        }

        $manager->flush();
        $manager->clear();

        for ($i = 0; $i < 1000; $i++) {
            CourseFactory::createOne();
        }

        $manager->flush();
    }
}
