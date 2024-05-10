<?php
namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('UserId')
            ->add('PaiementStripe')
            ->add('DateCommande', DateTimeType::class, [
                'required' => true, // Définir le champ comme obligatoire
                // Vous pouvez également définir d'autres options comme le format de date et d'heure, etc.
            ])
            ->add('StatutCommande')
            ->add('MontantTtc')
            ->add('user')
            ->add('Commande')
            ->add('DetailsCommande')
            ->add('AdresseFacturation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}