<?php

namespace App\Form;

use NumberFormatter;
use App\Entity\Contrats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContratsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('designation')
            //->add('slug')
            ->add('type', ChoiceType::class, [
                'label' => 'Choisissez un type de contrat',
                'choices' => [
                    'Stage' => 'Contrat de stage',
                    'Durée Déterminée' => 'Contrat Ã  durée déterminée',
                    'durée indéterminée' => 'Contrat Ã  durée indéterminée',
                    'Prestation' => 'Contrat de prestation'
                ]
            ])

            ->add('remuneration', MoneyType::class, [
                'scale' => 0,
                'grouping' => true,
                'rounding_mode' => NumberFormatter::ROUND_HALFUP,
                'divisor' => 1,
                'currency' => 'CFA',
                'compound' => false,
                'html5' => false,
                'invalid_message' => 'Please enter a valid money amount.',
                'attr' => ['placeholder' => 'Montant du salaire'],
            ])

            ->add('dateDebut', DateType::class, [
                'label' => 'Date de Naissance',
                'input' => 'datetime',
                //'html5' => false,
                'widget' => 'single_text',
                //'data'   => new \DateTime(),
                'attr'   => [
                    'min' => (new \DateTime('now -23725 day'))->format('Y-m-d'),
                    'max' => (new \DateTime('now -6570 day'))->format('Y-m-d')
                ]
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date de Naissance',
                'input' => 'datetime',
                //'html5' => false,
                'widget' => 'single_text',
                //'data'   => new \DateTime(),
                'attr'   => [
                    'min' => (new \DateTime('now -23725 day'))->format('Y-m-d'),
                    'max' => (new \DateTime('now -6570 day'))->format('Y-m-d')
                ]
            ])
            ->add('motiFinContrat', TextType::class, [
                'label' => 'Motif de fin du contrat',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Au motif de !!!'
                ]
            ])

            //->add('createdAt')
            //->add('updatedAt')
            ->add('etablissement')
            //->add('personnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrats::class,
        ]);
    }
}