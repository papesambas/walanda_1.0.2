<?php

namespace App\EventListener;

use App\Entity\Cercles;
use LogicException;
use App\Entity\Classes;
use App\Entity\Communes;
use App\Entity\Contrats;
use App\Entity\Cycles;
use App\Entity\Departements;
use App\Entity\EcoleProvenances;
use App\Entity\Enseignements;
use App\Entity\Etablissements;
use App\Entity\LieuNaissances;
use App\Entity\NiveauEtudes;
use App\Entity\Niveaux;
use App\Entity\Noms;
use App\Entity\Periodicites;
use App\Entity\Personnels;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class personnelsEntityListener
{


    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Personnels $personnel, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/


        $personnel
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setFullName($personnel->getNom() . ' ' . $personnel->getPrenom());
    }

    public function preUpdate(Personnels $personnel, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/

        $personnel
            ->setUpdatedAt(new \DateTimeImmutable('now'))
            ->setFullName($personnel->getNom() . ' ' . $personnel->getPrenom());
    }


    private function getClassesSlug(Personnels $personnel): string
    {
        $slug = mb_strtolower($personnel->getNom() . ' ' . $personnel->getPrenom(), 'UTF-8');
        return $this->$slug;
    }
}