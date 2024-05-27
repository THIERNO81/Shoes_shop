<?php

namespace App\Form;

use App\Entity\Transporteurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TransporteursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameTransport')
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control'
                ],
                'required' => false,
                'constraints' => [
                
                    new Length([
                        'max' => 500,
                        'maxMessage' => 'Veuillez saisir moins de 500 caractères'
                    ])
                ]
            ])
            ->add('prixTransport', MoneyType::class, [
                'label' => 'Prix du transport',
                'attr' => [
                    'placeholder' => 'Saisir le prix du Transport',
                    'class' => 'form-control'
                ],
                'currency' => 'EUR', // On peut changer la devise
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => ''
                    ]),
                    new Positive([
                        'message' => 'Veuillez saisir un prix supérieur à zéro'
                    ])
                ]
            ])
            
            ->add('createdAt')
            ->add('updatedAt', DateTimeType::class, [
                'required' => false,
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
    
}
