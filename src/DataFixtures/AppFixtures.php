<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}
    public function load(ObjectManager $manager): void
    {
       /* $faker = \Faker\Factory::create();
        $categories=[];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $name = $faker->word();
            $slug = $this->slugger->slug($name);
            $category
                ->setName($name)
                ->setSlug($slug);
            $manager->persist($category);
            $categories[] = $category;
        }
        for ($i = 0; $i < 10; $i++) {
            $picsi = $i+250;
            $randomCategory = $faker->randomElement($categories);
            $ad = new Ad();
            $randomDateTime = $faker->dateTimeThisCentury();
            $randomDateImmutable = new \DateTimeImmutable($randomDateTime->format('Y-m-d H:i:s'));
            $ad
                ->setTitle($faker->sentence(5))
                ->setDescription($faker->text())
                ->setCreatedAt($randomDateImmutable)
                ->setImage("https://picsum.photos/id/$picsi/150/150")
                ->setCategory($randomCategory);
            $manager->persist($ad);
        }
        $manager->flush();*/
    }
}
