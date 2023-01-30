<?php

namespace App\DataFixtures;

use App\Entity\Biker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class BikerFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setEmail($faker->safeEmail);

            $password = $this->hasher->hashPassword($user, '1234');
            $user->setPassword($password);

            $user->setRoles(['ROLE_BIKER']);
            $manager->persist($user);

            $biker = new Biker();
            $biker->setUser($user);
            $biker->setMobile($faker->phoneNumber);
            $biker->setCreatedAt(new \DateTime());
            $biker->setUpdatedAt(new \DateTime());
            $manager->persist($biker);
        }
        $manager->flush();
    }
}