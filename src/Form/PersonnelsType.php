<?php

namespace App\Form;

use App\Entity\Cercles;
use App\Entity\Communes;
use App\Entity\Noms;
use App\Entity\Prenoms;
use App\Entity\Regions;
use App\Entity\Personnels;
use App\Entity\Professions;
use App\Entity\Specialites;
use App\Entity\Departements;
use App\Entity\NiveauEtudes;
use App\Entity\Etablissements;
use App\Entity\LieuNaissances;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

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
                //'data'   => new \DateTime(),
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
                ],
                'placeholder' => "Situation Matrimoniale",
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
                'label' => 'Nom',
                'class' => Noms::class,
                'placeholder' => 'Entrez ou Sélectionnez un Nom',
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.designation', 'ASC');
                },
                'attr' => [
                    'class' => 'select-nomfamille'
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
                    'class' => 'select-niveauEtude',
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
                    'class' => 'select-departement'
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
                    'class' => 'select-etablissement',
                ],
            ])
            ->add('region', EntityType::class, [
                'class' => Regions::class,
                'placeholder' => 'Sélectionnez votre régions',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'select-region',
                ],
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.designation', 'ASC');
                },

            ]);
        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addCercleField($form->getParent(), $form->getData());
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                /**
                 * @var $lieuNaissance LieuNaissances
                 */
                $lieuNaissance = $data->getLieuNaissance();
                $form = $event->getForm();
                if ($lieuNaissance) {
                    $commune = $lieuNaissance->getCommune();
                    $cercle = $commune->getCercle();
                    $region = $cercle->getRegion();
                    $this->addCercleField($form, $region);
                    $this->addCommuneField($form, $cercle);
                    $this->addLieuNaissanceField($form, $commune);
                    $form->get('region')->setData($region);
                    $form->get('cercle')->setData($cercle);
                    $form->get('commune')->setData($commune);
                } else {
                    $this->addCercleField($form, null);
                    $this->addCommuneField($form, null);
                    $this->addLieuNaissanceField($form, null);
                }
            }
        );
    }

    /**
     * 
     * Ajouter le Champ Cercle
     * @param FormInterface $form
     * @param Regions $region
     * @return void
     */
    private function addCercleField(FormInterface $form, ?Regions $region)
    {

        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'cercle',
            EntityType::class,
            null,
            [
                'label' => "cercle",
                'class' => Cercles::class,
                'mapped' => false,
                'required' => false,
                'auto_initialize' => false,
                'placeholder' => $region ?  "Choisissez le cercle" : "Sélectionnez la région",
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.designation', 'ASC');
                },
                'choices' => $region ? $region->getCercles() : [],
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addCommuneField($form->getParent(), $form->getData());
                dump($event->getForm());
                dump($event->getForm()->getData());
            }
        );
        $form->add($builder->getForm());
    }

    /**
     * 
     * Ajouter le Champ Commune
     * @param FormInterface $form
     * @param Cercles $cercle
     * @return void
     */
    private function addCommuneField(FormInterface $form, ?Cercles $cercle)
    {

        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'commune',
            EntityType::class,
            null,
            [
                'label' => "commune",
                'class' => Communes::class,
                'mapped' => false,
                'required' => false,
                'auto_initialize' => false,
                'placeholder' => $cercle ? "Choisissez la commune" : "Sélectionnez le cercle",
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('co')
                        ->orderBy('co.designation', 'ASC');
                },
                'choices' => $cercle ? $cercle->getCommunes() : [],
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addLieuNaissanceField($form->getParent(), $form->getData());
                dump($event->getForm());
                dump($event->getForm()->getData());
            }
        );
        $form->add($builder->getForm());
    }

    /**
     * Summary of addLieuNaissanceField
     * @param FormInterface $form
     * @param Communes $commune
     * @return void
     */
    private function addLieuNaissanceField(FormInterface $form, ?Communes $commune)
    {

        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'lieuNaissance',
            EntityType::class,
            null,
            [
                'label' => "lieu de Naissance",
                'class' => LieuNaissances::class,
                'required' => false,
                'auto_initialize' => false,
                'placeholder' => $commune ? "Choisissez le lieu de Naissance" : "Sélectionnez la commune",
                'choice_label' => 'designation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->orderBy('l.designation', 'ASC');
                },
                'choices' => $commune ? $commune->getLieuNaissances() : [],
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                dump($event->getForm());
                dump($event->getForm()->getData());
            }
        );
        $form->add($builder->getForm());
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnels::class,
        ]);
    }
}