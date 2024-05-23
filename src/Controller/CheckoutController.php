<?php

namespace App\Controller;

use App\Entity\AdresseLivraison;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User; // Assurez-vous d'importer la classe User depuis le bon namespace

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Vérifier si l'utilisateur n'est pas connecté
        if (!$user instanceof User) {
            // Redirection vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Récupérer le panier de l'utilisateur s'il existe
        $panier = $user->getPanier();

        // Vérifier si le panier est vide ou non disponible
        if (!$panier) {
            // Redirection vers la page d'accueil si le panier n'existe pas
            $this->addFlash('checkout-message', 'Votre panier est vide. Ajoutez des produits pour passer à la caisse.');
            return $this->redirectToRoute('app_commande_add');
        }

        // Afficher la page de checkout avec les détails du panier
        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
            'panier' => $panier, // Passer le panier directement à la vue
        ]);
    }
    #[Route('/checkout/select-address/{id}', name: 'app_checkout_select_address')]
    public function selectAddress(int $id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Vérifier si l'utilisateur n'est pas connecté
        if (!$user instanceof User) {
            // Redirection vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Récupérer l'adresse de livraison spécifiée par l'identifiant
        $adresseLivraison = $entityManager->getRepository(AdresseLivraison::class)->find($id);

        // Vérifier si l'adresse de livraison existe
        if (!$adresseLivraison) {
            // Redirection ou affichage d'un message d'erreur si l'adresse n'est pas trouvée
            $this->addFlash('error', 'Adresse de livraison non trouvée.');
            return $this->redirectToRoute('app_checkout');
        }

        // Vous pouvez maintenant utiliser $adresseLivraison comme l'adresse sélectionnée
        // Par exemple, vous pouvez effectuer des opérations avec cette adresse, comme la sauvegarde dans une session ou dans la base de données
        
        // Redirection vers la page de checkout après la sélection de l'adresse
        return $this->redirectToRoute('app_checkout');
    }
}
