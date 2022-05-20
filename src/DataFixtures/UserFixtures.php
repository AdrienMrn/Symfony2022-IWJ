<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    /** @var UserPasswordHasherInterface $hasher */
    private $hasher;

    /** @var string $pwd */
    private $pwd = 'test';

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        $user = (new User())
            ->setEmail('dev@user')
            ->setRoles([]);
        $user->setPassword($this->hasher->hashPassword($user, $this->pwd));
        $manager->persist($user);

        $user = (new User())
            ->setEmail('dev@admin')
            ->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->hasher->hashPassword($user, $this->pwd));
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = (new User())
                ->setEmail($faker->email)
                ->setRoles([]);
            $user->setPassword($this->hasher->hashPassword($user, $this->pwd));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
