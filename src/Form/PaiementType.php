<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardHolderName', TextType::class, [
                'label' => 'Nom du titulaire de la carte',
                'required' => true,
            ])
            ->add('cardNumber', TextType::class, [
                'label' => 'Numéro de carte',
                'required' => true,
            ])
            ->add('expiryDate', TextType::class, [
                'label' => 'Date d\'expiration (MM/YY)',
                'required' => true,
            ])
            ->add('cvv', TextType::class, [
                'label' => 'Code de sécurité (CVV)',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Payer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // configure options here
        ]);
    }
}
