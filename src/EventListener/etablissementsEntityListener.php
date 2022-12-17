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
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class etablissementsEntityListener
{


    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Etablissements $etablissement, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/


        $etablissement
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getClassesSlug($etablissement));
    }

    public function preUpdate(Etablissements $etablissement, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/

        $etablissement
            ->setUpdatedAt(new \DateTimeImmutable('now'));
    }


    private function getClassesSlug(Etablissements $etablissement): string
    {
        $slug = mb_strtolower($etablissement->getDesignation() . '-' . $etablissement->getId(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}