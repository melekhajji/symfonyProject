<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\{
    FileType,
    TextType,
    ButtonType,
    EmailType,
    HiddenType,
    PasswordType,
    TextareaType,
    SubmitType,
    NumberType,
    MoneyType,
    BirthdayType};
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ColorType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('start',DateTimeType::class,[
                'date_widget' => 'single_text'])

            ->add('lieu',TextType::class,[
                'attr' => [
                    'placehelder' => " lieu",
                    'class' => 'form-control'

                ]
            ])

            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('title')
            ->add('end',DateTimeType::class,[
                'date_widget' => 'single_text'])

            ->add('description',TextareaType::class,
                array('attr' => array('cols' => '170', 'rows' => '5')))

            ->add('allday')

            ->add('lat')
            ->add('lon')
            ->add('capacite',TextType::class,[
                'attr' => [
                    'placehelder' => " capacite",
                    'class' => 'form-control'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
