<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\AdresseLivraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdresseLivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('UserId', null, [
            //     'attr' => ['class' => 'form-control'] // Utilisation de la classe Bootstrap pour les champs de formulaire
            // ])

            // ->add('UserId', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => '', // ou toute autre propriété de l'utilisateur à afficher
            //     'placeholder' => 'Sélectionner un utilisateur',
            //     'required' => true, // Assurez-vous que ce champ est requis
            // ])
            
            // ->add('LibRueAdresseLivraison', null, [
            //     'attr' => ['class' => 'form-control']
            // ])
            // ->add('CpAdresseLivraison', null, [
            //     'attr' => ['class' => 'form-control']
            // ])
            // ->add('VilleAdresseLivraison', null, [
            //     'attr' => ['class' => 'form-control']
            // ])
            // ->add('CommentaireAdresseLivr', null, [
            //     'attr' => ['class' => 'form-control'],
            //     'required' => false,
            // ]);
            
            ->add('LibRueAdresseLivraison', TextType::class)
            ->add('CpAdresseLivraison', TextType::class)
            ->add('VilleAdresseLivraison', TextType::class)
           
            
            ->add('CommentaireAdresseLivr', TextareaType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdresseLivraison::class,
        ]);
    }
}
