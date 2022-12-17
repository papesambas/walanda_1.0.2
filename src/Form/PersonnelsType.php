<?php

namespace App\Form;

use App\Entity\Personnels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sexe')
            ->add('dateNaissance')
            ->add('adresse')
            ->add('telephone')
            ->add('situationMatrimoniale')
            ->add('nbEnfants')
            ->add('fullName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('isActif')
            ->add('nom')
            ->add('prenom')
            ->add('lieuNaissance')
            ->add('profession')
            ->add('niveauEtude')
            ->add('specialite')
            ->add('departement')
            ->add('etablissement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnels::class,
        ]);
    }
}
