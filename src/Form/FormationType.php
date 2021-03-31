<?php

namespace App\Form;

use App\Entity\Formation;


use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,MoneyType,BirthdayType};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder





            ->add('nom',TextType::class,[
                'attr' => [
                    'placehelder' => " nom",
                    'class' => 'form-control'
                ]
            ])


          ->add('type', ChoiceType::class, [
                'choices' => [
                    'Formation certifiante' => 'Formation certifiante',
                    'Formation qualifiante' => 'Formation qualifiante',
                    'Formation en ligne' => 'Formation en ligne',
                    'Formation presentiel' => 'Formation presentiel',
                    'Formation en alternance' => 'Formation en alternance',
                    'Formation continu' => 'Formation continu',
                ],

            ])
            ->add('duree',TextType::class,[
                'attr' => [
                    'placehelder' => " duree",
                    'class' => 'form-control'
                ]
            ])
            ->add('prix',TextType::class,[
                'attr' => [
                    'placehelder' => " prix",
                    'class' => 'form-control'
                ]
            ])

            ->add('event')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
