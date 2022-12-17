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
use App\Entity\Users;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class usersEntityListener
{



    public function prePersist(Users $user, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/


        $user
            ->setCreatedAt(new \DateTimeImmutable('now'));
    }

    public function preUpdate(Users $user, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/

        $user
            ->setUpdatedAt(new \DateTimeImmutable('now'));
    }
}