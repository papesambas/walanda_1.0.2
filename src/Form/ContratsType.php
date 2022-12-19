<?php

namespace App\Form;

use App\Entity\Contrats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation')
            ->add('slug')
            ->add('type')
            ->add('remuneration')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('motiFinContrat')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('etablissement')
            ->add('personnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrats::class,
        ]);
    }
}
