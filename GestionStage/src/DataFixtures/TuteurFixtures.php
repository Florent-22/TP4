<?php
namespace App\DataFixtures;

use App\Entity\Tuteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TuteurFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $tuteur1 = new Tuteur();
        $tuteur1->setNom("Dupont")
            ->setPrenom("Benjamin")
            ->setTelephone("0123456789")
            ->setEmail("Dupont@a5sys.fr");

        $tuteur2 = new Tuteur();
        $tuteur2->setNom("Bourdon")
            ->setPrenom("Laura")
            ->setTelephone("0693809820")
            ->setEmail("bourdon@a5sys.fr");

        $tuteur3 = new Tuteur();
        $tuteur3->setNom("Roux")
            ->setPrenom("Olivier")
            ->setTelephone("0987654321")
            ->setEmail("roux@cgi.fr");

        $tuteur4 = new Tuteur();
        $tuteur4->setNom("Dubois")
            ->setPrenom("Marie")
            ->setTelephone("0987654321")
            ->setEmail("roux@capgemini.fr");


        $manager->persist($tuteur1);
        $manager->persist($tuteur2);
        $manager->persist($tuteur3);
        $manager->persist($tuteur4);

        $manager->flush();

        $this->addReference('tuteur-a5sys-1', $tuteur1);
        $this->addReference('tuteur-a5sys-2', $tuteur2);
        $this->addReference('tuteur-cgi', $tuteur3);
        $this->addReference('tuteur-capgemini', $tuteur4);

    }
}