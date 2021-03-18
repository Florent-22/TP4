<?php
namespace App\DataFixtures;

use App\Entity\Stage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $stage1 = new Stage();
        $description = <<< _lorem
Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
_lorem;
        $stage1->setCategorie($manager->merge($this->getReference('categorie-programmation')))
        ->setPoste('Developeur Web')
        ->setDescription($description)
        ->setType('Temps partiel')
        ->setActif(true)
        ->setSociete("A5Sys")
        ->setDateExpiration(new \DateTime('+30 days'))
        ->setEmail("Dupont@a5sys.fr")
        ->setVille("Nantes")
        ->addTuteur($manager->merge($this->getReference('tuteur-a5sys-1')))
        ->addTuteur($manager->merge($this->getReference('tuteur-a5sys-2')));
        $manager->persist($stage1);

        $stage2 = new Stage();
        $description = <<< _lorem
Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?_lorem;
_lorem;
        $stage2->setCategorie($manager->merge($this->getReference('categorie-tma')))
        ->setPoste('analyste programmeur')
        ->setDescription($description)
        ->setType('Temps plein')
        ->setActif(true)
        ->setSociete("CGI")
        ->setDateExpiration(new \DateTime('+30 days'))
        ->setEmail("Eveillard@cgi.fr")
        ->setVille("Carquefou")
        ->addTuteur($manager->merge($this->getReference('tuteur-cgi')));

        $manager->persist($stage2);

        $stage3 = new Stage();
        $description = <<< _lorem
At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat_lorem;
_lorem;
        $stage3->setCategorie($manager->merge($this->getReference('categorie-programmation')))
            ->setPoste('Developeur Web')
            ->setDescription($description)
            ->setType('Temps plein')
            ->setActif(true)
            ->setSociete("Capgemini")
            ->setDateExpiration(new \DateTime('+30 days'))
            ->setEmail("Bourdon@capgemini.fr")
            ->setVille("Paris")
            ->addTuteur($manager->merge($this->getReference('tuteur-capgemini')));
        $manager->persist($stage3);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            CategorieFixtures::class,
            TuteurFixtures::class,
        ];
    }
}