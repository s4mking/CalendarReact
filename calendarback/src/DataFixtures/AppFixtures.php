<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use Faker;
use App\Entity\User;
use App\Entity\Grade;
use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $em)
    {
        // initialisation de l'objet Faker
        $faker = Faker\Factory::create('fr_FR');

        // créations des shops
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[$i] = new User();
            $plainPassword = 'motdepas';
            $encoded = $this->encoder->encodePassword($users[$i], $plainPassword);
            // $encoded = $encoder->encodePassword($users[$i], $plainPassword);
            $users[$i]->setMail($faker->email)
                ->setPassword($encoded)
                ->setRoles(['ROLE_ADMIN'])
                ->setUsername($faker->userName);
            $em->persist($users[$i]);
        }
        // $matters = [];
        for ($k = 0; $k < 50; $k++) {
            $matters[$k] = new Booking();
            $matters[$k]->setTitle($faker->text($maxNbChars = 50));
            $matters[$k]->setEndAt($faker->dateTimeThisYear($max = 'now', $timezone = null));
            $matters[$k]->setBeginAt($faker->dateTime($max = 'now', $timezone = null));

            // on récupère un nombre aléatoire de Shops dans un tableau
            $randomUser = array_rand($users);
            $randomUsers2 = array_rand($users);
            $matters[$k]->setCreator($users[$randomUser]);
            $matters[$k]->setSubscribedUser($users[$randomUsers2]);
            // // puis on les ajoute au Customer
            // foreach ($randomUsers as $key => $value) {
            //     $matters[$k]->addRelatedUser($users[$key]);
            //     // $matters[$k]->setCreator($users[$key]);
            // }
            // foreach ($randomUsers2 as $key => $value) {
            //     $matters[$k]->addRelatedUser($users[$key]);
            //     // $matters[$k]->setCreator($users[$key]);
            // }
            $em->persist($matters[$k]);
        }


        $user = new User();
        $plainPassword = 'motdepas';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user
            ->setMail('sam@sam.fr')
            ->setUsername('samuel')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($encoded);

        $em->persist($user);

        $userStudent = new User();
        $plainPassword = 'motdepas';
        $encoded = $this->encoder->encodePassword($userStudent, $plainPassword);
        $userStudent
            ->setMail('sam@user.fr')
            ->setUsername('user')
            ->setRoles(['ROLE_USER'])
            ->setPassword($encoded);

        $em->persist($userStudent);

        $user = new User();
        $plainPassword = 'motdepas';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user
            ->setMail('samo@user.fr')
            ->setUsername('teacher')
            ->setRoles(['ROLE_PRO'])
            ->setPassword($encoded);

        $em->persist($user);

        // $grades = [];
        // for ($j = 0; $j < 50; $j++) {
        //     $grades[$j] = new Grade();
        //     $grades[$j]->setValue($faker->numberBetween(0, 20));

        //     // on récupère un nombre aléatoire de Shops dans un tableau
        //     $randomMatters = (array) array_rand($matters, rand(1, count($matters)));
        //     // puis on les ajoute au Customer
        //     foreach ($randomMatters as $key => $value) {
        //         $grades[$j]->setSubject($matters[$key]);
        //         $grades[$j]->setAssignedStudent($userStudent);
        //     }
        //     $em->persist($grades[$j]);
        // }

        $em->flush();
    }
}
