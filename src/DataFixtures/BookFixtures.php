<?php

namespace App\DataFixtures;

use App\Factory\BookFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Crée 10 livres avec des couvertures et des textes générés
        BookFactory::createMany(10);

        $manager->flush();
    }
}
