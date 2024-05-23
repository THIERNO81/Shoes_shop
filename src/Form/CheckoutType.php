<?php

namespace App\Form;

use App\Entity\Transporteurs;
use App\Entity\AdresseLivraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user']; //injection des données de l'utilisateur

        $builder
            ->add('AdresseLivraison', EntityType::class, [
                'class'=>AdresseLivraison::class,
                'required'=>true,
                'choices'=>$user->getAdresseLivraison(),
                'multiple'=>false,
                'expanded'=>true,
            ])
            ->add('Transporteurs', EntityType::class, [
                'class'=>Transporteurs::class,
                'required'=>true,
                'multiple'=>false,
                'expanded'=>true,
            ])
            ->add('informations', TextareaType::class, [
                'required'=>false,
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => Array()
        ]);
    }
}




// class CheckoutType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//        

//         $builder
//             ->add('UserId')
//             ->add('LibRueAdresseLivraison')
//             ->add('CpAdresseLivraison')
//             ->add('VilleAdresseLivraison')
//             ->add('CommentaireAdresseLivr')
//             ->add('user')
//         ;
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => AdresseLivraison::class,
//         ]);
//     }
// }
