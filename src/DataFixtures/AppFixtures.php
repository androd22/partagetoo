<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $picsi = $i+250;
            $ad = new Ad();
            $randomDateTime = $faker->dateTimeThisCentury();

            $randomDateImmutable = new \DateTimeImmutable($randomDateTime->format('Y-m-d H:i:s'));
            $ad
                ->setTitle($faker->sentence(5))
                ->setDescription($faker->text())
                ->setCreatedAt($randomDateImmutable)
                ->setImage("https://picsum.photos/id/$picsi/150/150");
            $manager->persist($ad);
        }
        $manager->flush();
    }
}
