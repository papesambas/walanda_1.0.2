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
use App\Entity\Prenoms;
use App\Entity\Professions;
use App\Entity\Regions;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class regionsEntityListener
{


    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Regions $region, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/


        $region
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getClassesSlug($region));
    }

    public function preUpdate(Regions $region, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/

        $region
            ->setUpdatedAt(new \DateTimeImmutable('now'));
    }


    private function getClassesSlug(Regions $region): string
    {
        $slug = mb_strtolower($region->getDesignation() . '-' . $region->getId(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}