<?php

namespace App\EventListener;

use App\Entity\Cercles;
use LogicException;
use App\Entity\Classes;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class cerclesEntityListener
{


    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Cercles $cercles, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/


        $cercles
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getClassesSlug($cercles));
    }

    public function preUpdate(Cercles $cercles, LifecycleEventArgs $arg): void
    {
        /*$user = $this->Securty->getUser();
        if ($user === null) {
            throw new LogicException('User cannot be null here ...');
        }*/

        $cercles
            ->setUpdatedAt(new \DateTimeImmutable('now'));
    }


    private function getClassesSlug(Cercles $cercles): string
    {
        $slug = mb_strtolower($cercles->getDesignation() . '-' . $cercles->getId(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}