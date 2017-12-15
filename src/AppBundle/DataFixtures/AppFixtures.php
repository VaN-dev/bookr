<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use AppBundle\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3; $i++) {
            $user = (new User())
                ->setUsername("user #".$i)
            ;

            $manager->persist($user);

            for ($j = 1; $j <= 5; $j++) {
                $book = (new Book())
                    ->setTitle("book #".$j." written by user #".$i)
                    ->setOwner($user)
                ;

                $manager->persist($book);
            }
        }

        $manager->flush();
    }
}