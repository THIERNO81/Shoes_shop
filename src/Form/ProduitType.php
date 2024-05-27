<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
// use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('id', IntegerType::class, [
            'label' => 'ID du produit',
            'attr' => [
                'readonly' => true, // Ajoutez ceci pour rendre le champ en lecture seule
                'class' => 'form-control'
            ],
            'required' => false, // Vous pouvez modifier cela en fonction de vos besoins
        ])
        ->add('nomProduit', TextType::class, [
            'label' => 'Nom du produit',
            'attr' => [
                'placeholder' => 'Saisir le nom du produit',
                'class' => 'form-control'
            ],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir le nom du produit'
                ]),
                new Length([
                    'min' => 4,
                    'max' => 200,
                ])
            ]
        ])
        // Dans votre méthode buildForm
        ->add('descriptionProduit', TextType::class, [
            'label' => 'Description du produit',
            'attr' => [
                'placeholder' => 'Saisir la description du produit',
                'class' => 'form-control'
            ],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir la description du produit'
                ]),
                new Length([
                    'max' => 500,
                    'maxMessage' => 'Veuillez saisir moins de 500 caractères'
                ])
            ]
        ])
        ->add('prixProduit', MoneyType::class, [
            'label' => 'Prix du produit',
            'attr' => [
                'placeholder' => 'Saisir le prix du produit',
                'class' => 'form-control'
            ],
            'currency' => 'EUR', // On peut changer la devise
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir le prix du produit'
                ]),
                new Positive([
                    'message' => 'Veuillez saisir un prix supérieur à zéro'
                ])
            ]
        ])
        
        ->add('stockDispo', IntegerType::class, [
            'label' => 'Le stock disponible',
            'attr' => [
                'placeholder' => 'Derouler pour définir le stock disponible',
                'class' => 'form-control'
            ],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir le stock disponible'
                ]),
                new Positive([
                    'message' => 'Veuillez saisir un stock supérieur ou est égale à zéro'
                ])
            ]
        ])
        ->add('taille', TextType::class, [
            'label' => 'La taille',
            'attr' => [
                'placeholder' => 'Choisir la taille',
                'class' => 'form-control'
            ],
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir la taille'
                ]),
                new Length([
                    'max' => 10,
                    'maxMessage' => 'La taille ne doit pas dépasser 10 caractères'
                ])
            ]
        ])


        ->add('imagePath', TextType::class, [ // Ajout du champ imagePath
            'label' => 'Chemin de l\'image',
            'attr' => [
                'placeholder' => 'Saisir le chemin de l\'image',
                'class' => 'form-control'
            ],
            'required' => false, // Vous pouvez modifier cela en fonction de vos besoins
        ])
            ->add('imageFile', VichImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}

