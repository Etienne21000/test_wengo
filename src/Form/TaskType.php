<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le titre'
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le titre doit contenir au moins 2 caractères',
                        'maxMessage' => 'Le titre ne peut pas dépasser 255 caractères'
                    ])
                    ],
                'label' => 'Titre',
                'empty_data' => ''
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'constraints' => new NotBlank([
                    'message' => 'Veuillez renseigner le contenu'
                ]),
                'empty_data' => ''
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'Etat',
                'choices' => [
                    'state' => [
                        'a faire' => 0,
                        'à terminer' => 1,
                        'terminée' => 2
                    ]
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
