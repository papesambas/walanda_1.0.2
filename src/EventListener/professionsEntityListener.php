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
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class professionsEntityListener
{


    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Professions $profession, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/


        $profession
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getClassesSlug($profession));
    }

    public function preUpdate(Professions $profession, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/

        $profession
            ->setUpdatedAt(new \DateTimeImmutable('now'));
    }


    private function getClassesSlug(Professions $profession): string
    {
        $slug = mb_strtolower($profession->getDesignation() . '-' . $profession->getId(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}