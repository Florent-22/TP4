<?php
namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $programmationCategorieCategorie = new Categorie();
        $programmationCategorieCategorie->setNom('Programmation');

        $adminCategorie = new Categorie();
        $adminCategorie->setNom('Administration du parc informatique');

        $tmaCategorie = new Categorie();
        $tmaCategorie->setNom('TMA');

        $designCategorie = new Categorie();
        $designCategorie->setNom('Design');

        $manager->persist($programmationCategorieCategorie);
        $manager->persist($adminCategorie);
        $manager->persist($tmaCategorie);
        $manager->persist($designCategorie);

        $manager->flush();

        $this->addReference('categorie-programmation', $programmationCategorieCategorie);
        $this->addReference('categorie-administrateur', $adminCategorie);
        $this->addReference('categorie-tma', $tmaCategorie);
        $this->addReference('categorie-design', $designCategorie);
    }
}