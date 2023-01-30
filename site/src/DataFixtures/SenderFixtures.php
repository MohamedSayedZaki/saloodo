<?php

namespace App\DataFixtures;

use App\Entity\Sender;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class SenderFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setEmail($faker->safeEmail);

            $password = $this->hasher->hashPassword($user, '1234');
            $user->setPassword($password);

            $user->setRoles(['ROLE_SENDER']);
            $manager->persist($user);

            $biker = new Sender();
            $biker->setUser($user);
            $biker->setMobile($faker->phoneNumber);
            $biker->setCreatedAt(new \DateTime());
            $biker->setUpdatedAt(new \DateTime());
            $manager->persist($biker);
        }

        $manager->flush();
    }
}