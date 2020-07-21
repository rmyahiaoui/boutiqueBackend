<?php

namespace App\DataFixtures;

use App\Entity\Chaussure;
use App\Entity\Couleur;

use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ChaussureFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $couleur = new Couleur();
        $couleur->setNom('rouge');
        $manager->persist($couleur);

        $couleur = new Couleur();
        $couleur->setNom('noir');
        $manager->persist($couleur);

        $couleur = new Couleur();
        $couleur->setNom('blanc');
        $manager->persist($couleur);

        $couleur = new Couleur();
        $couleur->setNom('vert');
        $manager->persist($couleur);

        $couleur = new Couleur();
        $couleur->setNom('gris');
        $manager->persist($couleur);

        $manager->flush();


        $repositoryCouleur = $manager->getRepository(Couleur::class);
        $chaussure = new Chaussure();
        $chaussure->setMarque('adidas');
        $chaussure->setMatiere('tissu');
        $chaussure->setType('sport');
        $couleur = $repositoryCouleur->findOneBy(array('nom' => 'blanc'));
        $chaussure->setCouleur($couleur);
        $chaussure->setPrix(100);
        $chaussure->setDateVente(new DateTime());
        $manager->persist($chaussure);


        $chaussure = new Chaussure();
        $chaussure->setMarque('nike');
        $chaussure->setMatiere('cuir');
        $chaussure->setType('sport');
        $couleur = $repositoryCouleur->findOneBy(array('nom' => 'noir'));
        $chaussure->setCouleur($couleur);
        $chaussure->setPrix(150);
        $chaussure->setDateVente(new DateTime());
        $manager->persist($chaussure);


        $chaussure = new Chaussure();
        $chaussure->setMarque('puma');
        $chaussure->setMatiere('cuir');
        $chaussure->setType('sport');
        $couleur = $repositoryCouleur->findOneBy(array('nom' => 'gris'));
        $chaussure->setCouleur($couleur);
        $chaussure->setPrix(150);
        $chaussure->setDateVente(new DateTime());
        $manager->persist($chaussure);

        $chaussure = new Chaussure();
        $chaussure->setMarque('celio');
        $chaussure->setMatiere('cuir');
        $chaussure->setType('ville');
        $couleur = $repositoryCouleur->findOneBy(array('nom' => 'noir'));
        $chaussure->setCouleur($couleur);
        $chaussure->setPrix(150);
        $chaussure->setDateVente(new DateTime());
        $manager->persist($chaussure);

        $chaussure = new Chaussure();
        $chaussure->setMarque('jules');
        $chaussure->setMatiere('cuir');
        $chaussure->setType('ville');
        $couleur = $repositoryCouleur->findOneBy(array('nom' => 'rouge'));
        $chaussure->setCouleur($couleur);
        $chaussure->setPrix(150);
        $chaussure->setDateVente(new DateTime());
        $manager->persist($chaussure);

        $manager->flush();
    }
}
