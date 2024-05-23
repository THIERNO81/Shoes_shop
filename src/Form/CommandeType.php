<?php
namespace App\Form;

use App\Entity\Commande;
use App\Entity\Transporteurs;
use App\Entity\AdresseLivraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       /** @var User */
    $user = $options['user'];

    $builder
        ->add('AdresseLivraison', EntityType::class, [
            'class' => AdresseLivraison::class,
            'placeholder' => "Sélectionner l'adresse de livraison",
            'multiple' => false,
            'expanded' => false,
            'constraints' => [
                new NotBlank(['message' => "L'adresse de livraison est obligatoire."]),
                new Type([
                    'type' => AdresseLivraison::class,
                    'message' => "L'adresse sélectionnée n'est pas valide."
                ])
            ]
        ])
        
        ->add('Transporteurs', EntityType::class, [
            'class' => Transporteurs::class,
            'choice_label' => 'nameTransport',
            'placeholder' => "Sélectionner le transporteur",
            'multiple' => false,
            'expanded' => false,
            'constraints' => [
                new NotBlank(['message' => "Le choix du transporteur est obligatoire."]),
                new Type([
                    'type' => Transporteurs::class,
                    'message' => "Le transporteur sélectionné est invalide."
                ])
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
       
        $resolver->setDefaults([
            "user" => []
            // 'data_class' => Commande::class,
        ]);
    }
}
// class CommandeType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('UserId')
//             ->add('PaiementStripe')
//             ->add('DateCommande', DateTimeType::class, [
//                 'required' => true, // Définir le champ comme obligatoire
//                 // Vous pouvez également définir d'autres options comme le format de date et d'heure, etc.
//             ])
//             ->add('StatutCommande')
//             ->add('MontantTtc')
//             ->add('user')
//             ->add('Commande')
//             ->add('DetailsCommande')
//             ->add('AdresseFacturation')
//         ;
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => Commande::class,
//         ]);
//     }
// }