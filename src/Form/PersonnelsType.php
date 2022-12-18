<?php

namespace App\Form;

use App\Entity\Noms;
use App\Entity\Prenoms;
use App\Entity\Regions;
use App\Entity\Personnels;
use App\Entity\Professions;
use App\Entity\Specialites;
use App\Entity\Departements;
use App\Entity\Etablissements;
use App\Entity\NiveauEtudes;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PersonnelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sexe', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'M' => 'Masculin',
                    'F' => 'Féminin'
                ],
                'label_attr' => [
                    'class' => 'radio-inline'
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'label' => 'Date de Naissance',
                'input' => 'datetime',
                //'html5' => false,
                'widget' => 'single_text',
                'data'   => new \DateTime(),
                'attr'   => [
                    'min' => (new \DateTime('now -23725 day'))->format('Y-m-d'),
                    'max' => (new \DateTime('now -6570 day'))->format('Y-m-d')
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['placeholder' => "Saississez l'adresse"]
            ])
            ->add('telephone')
            ->add('situationMatrimoniale', ChoiceType::class, [
                'label' => 'Situation matrimoniale',
                'choices' => [
                    'Célibataire' => 'Célibataire',
                    'Marié(e)' => 'Marié(e)',
                    'Divorcé(e)' => 'Divorcé(e)',
                    'Veuf/ve' => 'veuf/ve',
                ]
            ])
            ->add('nbEnfants', IntegerType::class, [
                'attr' => [
                    'placeholder' => "Nombre d'enfants"
                ],
            ])
            //->add('fullName')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('isActif')
            ->add('nom', EntityType::class, [
                'class' => Noms::class,
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.designation', 'ASC');
                },
                'placeholder' => 'Entrez ou Sélectionnez un nom',
                'attr' => [
                    'class' => 'select-nom'
                ]
            ])
            ->add('prenom', EntityType::class, [
                'class' => Prenoms::class,
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.designation', 'ASC');
                },
                'placeholder' => 'Entrez ou Sélectionnez un prénom',
                'attr' => [
                    'class' => 'select-prenom'
                ]
            ])
            ->add('lieuNaissance')
            ->add('profession', EntityType::class, [
                'label' => 'Profession',
                'class' => Professions::class,
                'placeholder' => 'Entrez ou Sélectionnez la Profession',
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.designation', 'ASC');
                },
                'attr' => [
                    'class' => 'select-profession'
                ]
            ])
            ->add('niveauEtude', EntityType::class, [
                'label' => "Niveau d'étude",
                'class' => NiveauEtudes::class,
                'placeholder' => "Choisissez le niveau d'étude",
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ne')
                        ->orderBy('ne.designation', 'ASC');
                },
                'attr' => [
                    'class' => 'select2',
                ]
            ])
            ->add('specialite', EntityType::class, [
                'class' => Specialites::class,
                'multiple' => true,
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('sp')
                        ->orderBy('sp.designation', 'ASC');
                },
                'by_reference' => false,
                'placeholder' => 'Choisissez une ou des Spécialités',
                'attr' => [
                    'class' => 'select-specialite',
                    'placeholder' => 'Choisissez une ou des Spécialités',
                ],
            ])
            ->add('departement', EntityType::class, [
                'class' => Departements::class,
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->orderBy('d.designation', 'ASC');
                },
                'placeholder' => 'Choisissez un Département',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('etablissement', EntityType::class, [
                'class' => Etablissements::class,
                'multiple' => true,
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.designation', 'ASC');
                },
                'by_reference' => false,
                'placeholder' => 'Choisissez un ou des établissements',
                'attr' => [
                    'class' => 'select2',
                    'placeholder' => 'Choisissez un ou des établissements',
                ],
            ])
            ->add('region', EntityType::class, [
                'class' => Regions::class,
                'placeholder' => 'Sélectionnez votre régions',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'select2',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnels::class,
        ]);
    }
}