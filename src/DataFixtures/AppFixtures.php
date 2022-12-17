<?php

namespace App\DataFixtures;

use App\Entity\Cercles;
use Faker;
use App\Entity\Noms;
use App\Entity\Users;
use App\Entity\Cycles;
use App\Entity\Classes;
use App\Entity\Niveaux;
use App\Entity\Prenoms;
use App\Entity\Regions;
use App\Entity\Statuts;
use App\Entity\Communes;
use App\Entity\Personnels;
use App\Entity\Professions;
use App\Entity\Specialites;
use App\Entity\Departements;
use App\Entity\NiveauEtudes;
use App\Entity\Periodicites;
use App\Entity\Enseignements;
use App\Entity\Etablissements;
use App\Entity\LieuNaissances;
use App\Entity\EcoleProvenances;
use App\Entity\Recrutements;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i < 2; $i++) {
            $etablissement = new Etablissements();
            $etablissement->setDesignation('Etablissement' . '_' . $i);
            $etablissement->setFormeJuridique('Entreprise Personneles');
            $etablissement->setAdresse('Baco Djicoroni');
            $etablissement->setCpteBancaire($faker->creditCardNumber('Visa', true, '_'));
            $etablissement->setDateOuverture(new \DateTime());
            $etablissement->setEmail($faker->email());
            $etablissement->setNumDecisionCreation($faker->bothify('??-####-??-###'));
            $etablissement->setNumDecisionOuverture($faker->bothify('??-####-??-###'));
            $etablissement->setNumFiscal($faker->bothify('??-###-??##-?-###'));
            $etablissement->setNumSocial($faker->bothify('###-??###-??-####'));
            $etablissement->setTelephone($faker->phoneNumber());
            $etablissement->setTelephoneMobile($faker->phoneNumber());
            $manager->persist($etablissement);
            $this->addReference('etablissement_' . $i, $etablissement);
        }

        for ($i = 1; $i <= 2; $i++) {
            $enseignement = new Enseignements();
            $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
            $enseignement->setDesignation('Enseignement Type' . '_' . $i);
            $enseignement->setEtablissement($etablissement);
            $manager->persist($enseignement);
            $this->addReference('enseignement_' . $i, $enseignement);
        }

        for ($i = 1; $i <= 4; $i++) {
            $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(1, 2));
            $cycle = new Cycles();
            $cycle->setDesignation('cycle' . '_' . $i);
            $cycle->setEnseignement($enseignement);
            $manager->persist($cycle);
            $this->addReference('cycle_' . $i, $cycle);
        }

        for ($i = 1; $i <= 15; $i++) {
            $cycle = $this->getReference('cycle_' . $faker->numberBetween(1, 4));
            $niveau = new Niveaux();
            $niveau->setDesignation('niveau' . '_' . $i);
            $niveau->setCycle($cycle);
            $manager->persist($niveau);
            $this->addReference('niveau_' . $i, $niveau);
        }

        for ($i = 1; $i <= 30; $i++) {
            $niveau = $this->getReference('niveau_' . $faker->numberBetween(1, 15));
            $classe = new Classes();
            $classe->setDesignation('classe' . '_' . $i);
            $classe->setCapacite('45');
            $classe->setNiveau($niveau);
            $manager->persist($classe);
            $this->addReference('classe_' . $i, $classe);
        }

        for ($i = 1; $i <= 50; $i++) {
            $nom = new Noms();
            $nom->setDesignation($faker->lastName);
            $manager->persist($nom);
            $this->addReference('nom_' . $i, $nom);
        }

        for ($i = 1; $i <= 100; $i++) {
            $prenom = new Prenoms();
            $prenom->setDesignation($faker->firstName);
            $manager->persist($prenom);
            $this->addReference('prenom_' . $i, $prenom);
        }

        for ($i = 1; $i <= 250; $i++) {
            $profession = new Professions();
            $profession->setDesignation($faker->jobTitle);
            $manager->persist($profession);
            $this->addReference('profession_' . $i, $profession);
        }

        for ($i = 1; $i <= 7; $i++) {
            $region = new Regions();
            $region->setDesignation('region' . '_' . $i);
            $manager->persist($region);
            $this->addReference('region_' . $i, $region);
        }

        for ($i = 1; $i <= 23; $i++) {
            $cercle = new Cercles();
            $region = $this->getReference('region_' . $faker->numberBetween(1, 7));
            $cercle->setRegion($region);
            $cercle->setDesignation('cercle' . ' ' . $i);
            $manager->persist($cercle);
            $this->addReference('cercle_' . $i, $cercle);
        }


        for ($i = 1; $i <= 45; $i++) {
            $commune = new Communes();
            $cercle = $this->getReference('cercle_' . $faker->numberBetween(1, 23));
            $commune->setCercle($cercle);
            $commune->setDesignation('commune' . ' ' . $i);
            $manager->persist($commune);
            $this->addReference('commune_' . $i, $commune);
        }

        for ($i = 1; $i <= 175; $i++) {
            $lieu = new LieuNaissances();
            $commune = $this->getReference('commune_' . $faker->numberBetween(1, 45));
            $lieu->setCommune($commune);
            $lieu->setDesignation($faker->streetName);
            $manager->persist($lieu);
            $this->addReference('lieu_' . $i, $lieu);
        }

        for ($i = 1; $i <= 75; $i++) {
            $specialite = new Specialites();
            $specialite->setDesignation('Spécialité' . '_' . $i);
            $manager->persist($specialite);
            $this->addReference('specialite_' . $i, $specialite);
        }

        for ($i = 1; $i <= 10; $i++) {
            $departement = new Departements();
            $departement->setDesignation('Département' . '_' . $i);
            $manager->persist($departement);
            $this->addReference('departement_' . $i, $departement);
        }

        for ($i = 1; $i <= 200; $i++) {
            $ecole = new EcoleProvenances();
            $ecole->setDesignation($faker->company);
            $manager->persist($ecole);
            $this->addReference('ecole_' . $i, $ecole);
        }

        for ($i = 1; $i <= 15; $i++) {
            $nivEtude = new NiveauEtudes();
            $nivEtude->setDesignation("niveau d'étude" . '_' . $i);
            $manager->persist($nivEtude);
            $this->addReference('nivEtude_' . $i, $nivEtude);
        }

        for ($i = 1; $i <= 12; $i++) {
            $periode = new Periodicites();
            $periode->setDesignation("periode" . '_' . $i);
            $manager->persist($periode);
            $this->addReference('periode_' . $i, $periode);
        }

        for ($i = 1; $i <= 25; $i++) {
            $statut = new Statuts();
            $statut->setDesignation("statut" . '_' . $i);
            $manager->persist($statut);
            $this->addReference('statut_' . $i, $statut);
        }

        for ($i = 1; $i <= 15; $i++) {
            if ($i == 1) {
                $user = new Users();
                $password = 'superadmin';
                $password = $this->encoder->hashPassword($user, $password);
                $user->setFullName('superadmin');
                $user->setUsername('superadmin');
                $user->setEmail($faker->email());
                $user->setPassword($password);
                $user->setIsActif($faker->numberBetween(0, 1));
                $user->setIsVerified($faker->numberBetween(0, 1));

                $manager->persist($user);
                $this->addReference('user_' . $i, $user);
            } else {
                $nom = $this->getReference('nom_' . $faker->numberBetween(1, 50));
                $prenom = $this->getReference('prenom_' . $faker->numberBetween(1, 50));
                $fullName = $nom . ' ' . $prenom;
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, $password);
                $user->setFullName($fullName);
                $user->setUsername('Utilisateur_' . $i);
                $user->setEmail($faker->email());
                $user->setPassword($password);
                $user->setIsActif($faker->numberBetween(0, 1));
                $user->setIsVerified($faker->numberBetween(0, 1));

                $manager->persist($user);
                $this->addReference('user_' . $i, $user);
            }
        }

        for ($i = 1; $i <= 8; $i++) {
            $departement = $this->getReference('departement_' . $faker->numberBetween(1, 7));
            $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
            $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100));
            $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50));
            $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100));
            $niveau  = $this->getReference('nivEtude_' . $faker->numberBetween(1, 10));
            $specialite  = $this->getReference('specialite_' . $faker->numberBetween(1, 25));
            $profession  = $this->getReference('profession_' . $faker->numberBetween(1, 150));
            $etablissement  = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
            $user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
            $employe = new Personnels();
            $employe->setAdresse($faker->address());
            $employe->setDateNaissance(new \DateTimeImmutable());
            $employe->setLieuNaissance($lieu);
            $employe->setDepartement($departement);
            $employe->addEtablissement($etablissement);
            $employe->setFullName($nom . ' ' . $prenom);
            $employe->setNbEnfants($faker->numberBetween(0, 5));
            $employe->setNiveauEtude($niveau);
            $employe->setNom($nom);
            $employe->setPrenom($prenom);
            $employe->setSexe('M');
            $employe->setProfession($profession);
            $employe->setSituationMatrimoniale('Célibataire');
            $employe->addSpecialite($specialite);
            $employe->addUser($user);

            $manager->persist($employe);
            $this->addReference('employe_' . $i, $employe);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}