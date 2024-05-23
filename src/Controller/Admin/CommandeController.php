<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Form\PaiementType;
use App\Entity\DetailsCommande;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/commande', name: 'app_commande_')]
class CommandeController extends AbstractController
{
    #[Route('/show', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepository, EntityManagerInterface $em, Request $request): Response
    {
        /**
         * Recuperons l'utilisateur actuellement connecté
         * @var User 
         */

        $user = $this->getUser();
        if (!$user) {
            // Rediriger vers une page de connexion ou afficher un message d'erreur
            $this->addFlash('error', 'Vous devez être connecté pour passer une commande.');
            return $this->redirectToRoute('app_login');
        }

        $this->denyAccessUnlessGranted('ROLE_USER');
        $panier = $session->get('panier', []);

        if ($panier === []) {
            $this->addFlash('message', 'Veuillez rajouter les produits dans le panier');
            return $this->redirectToRoute('panier_index');
        }  


        //le panier n'est pas vide, on crée la commande
        $commande = new commande();
        $NomProduit = "Nom du produit";


        $form = $this->createForm(CommandeType::class, null);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd('ok');
            $em->persist($commande);
            $em->flush();

            $this->addFlash('success', 'Commande passée avec succès.');
            return $this->redirectToRoute('commande_success');
        }
        
        // dd('non ok');

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }


    #[Route('/recalcul', name: 'addRecalcul')]
    public function submitcommande(EntityManagerInterface $em, Request $request): Response
    {
        // Récupérer les données de la requête
        $requestData = $request->request->all();

        // Si vous avez besoin de récupérer des données spécifiques de la commande,
        // vous pouvez les extraire ici à partir des données de la requête

        // Exemple : Récupération de l'identifiant de la commande
        $commandeId = $requestData['commande_id'];

        // Récupérer la commande depuis la base de données en fonction de son identifiant
        $commande = $em->getRepository(Commande::class)->find($commandeId);

        if (!$commande) {
            return new Response('Commande non trouvée.', 404);
        }

        // Effectuer ici le recalcul ou la mise à jour de la commande
        // Exemple : Recalculer le montant total de la commande

        // Supposons que vous ayez une méthode spécifique pour recalculer le montant
        $newTotalAmount = $this->recalculateTotalAmount($commande);

        // Mettre à jour le montant total de la commande
        $commande->setMontantTotal($newTotalAmount);

        // Enregistrer les modifications dans la base de données
        $em->flush();

        // Rediriger l'utilisateur ou renvoyer une réponse appropriée
        return new Response('Recalcul de la commande effectué avec succès.');
    }

    // Méthode pour recalculer le montant total de la commande
    private function recalculateTotalAmount(Commande $commande): float
    {
        // Initialise le montant total à 0
        $totalAmount = 0.0;

        // Récupère tous les détails de la commande
        $detailsCommande = $commande->getDetailsCommande();

        // Parcourt chaque détail de la commande
        foreach ($detailsCommande as $detail) {
            // Récupère le prix et la quantité du détail
            $prix = $detail->getPrix();
            $quantite = $detail->getQuantite();

            // Calcule le montant pour ce détail en multipliant le prix par la quantité
            $montantDetail = $prix * $quantite;

            // Ajoute le montant du détail au montant total de la commande
            $totalAmount += $montantDetail;
        }

        // Retourne le montant total de la commande
        return $totalAmount;
    }



    #[Route('/paiementform', name: 'paiementform')]
    public function showpaiementform(Request $request): Response
    {
        dd('ok');
        // Création du formulaire de paiement en utilisant PaiementType
        $form = $this->createForm(PaiementType::class);

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Les données du formulaire sont valides, vous pouvez les récupérer
            $data = $form->getData();

            // Exemple : Traitez le paiement avec les données récupérées
            // $paymentService->processPayment($data);

            // Enregistrement de la commande (utilisation de $data dans savecommande par exemple)
            $saved = $this->savecommande($data);

            if (!$saved) {
                return new Response('Erreur lors de l\'enregistrement en base de données', 500);
            }

            // Redirigez l'utilisateur ou affichez un message de succès
            return new Response('Commande enregistrée avec succès');
        }

        // Rendu du formulaire de paiement dans le template approprié
        return $this->render('commande/paiement_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function savecommande($datacommande)
    {
        try {
            // Insérez ici la logique pour enregistrer la commande en base de données
            // Exemple :
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($datacommande);
            // $entityManager->flush();

            // Retourne true si l'enregistrement est réussi
            return true;
        } catch (\Exception $e) {
            // Retourne false en cas d'erreur lors de l'enregistrement
            return false;
        }
    }


    // namespace App\Controller\Admin;

    // use App\Entity\Commande;
    // use App\Entity\DetailsCommande;
    // use App\Repository\ProduitRepository;
    // use Doctrine\ORM\EntityManagerInterface;
    // use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    // use Symfony\Component\HttpFoundation\Response;
    // use Symfony\Component\HttpFoundation\Session\SessionInterface;
    // use Symfony\Component\Routing\Annotation\Route;

    // #[Route('/commande', name: 'app_commande_')]
    // class CommandeController extends AbstractController
    // {
    //     #[Route('/ajout', name: 'add')]
    //     public function add(SessionInterface $session, ProduitRepository $produitRepository, EntityManagerInterface $em): Response
    //     {
    //         $this->denyAccessUnlessGranted('ROLE_USER');

    //         $panier = $session->get('panier', []);

    //         if ($panier === []) {
    //                         $this->addFlash('message', 'Votre panier est vide');
    //                         return $this->redirectToRoute('app_welcome');
    //                          }

    //         //le panier n'est pas vide, on crée la commande
    //         $commande = new commande();
    //         $NomProduit = "Nom du produit";


    //         //on remplit la commande
    //         $commande->setUser($this->getUser());
    //         $commande->setUserId((int)uniqid());

    //         // on parcourt le panier pour créer les détails de commande
    //         foreach ($panier as $itemId => $qteDetailsCommande) {
    //             $detailsCommande = new DetailsCommande();

    //         //on va chercher le produit
    //         $itemId = (string) $itemId;
    //         $produit = $produitRepository->find($itemId);

    //         $prixTtc = $produit->getPrixProduit();



    //             // Récupérer le nom du produit et l'associer au détail de commande
    //             $detailsCommande->setNomProduit($NomProduit);

    //             // Récupérer le prix TTC du produit et l'associer au détail de commande
    //             $detailsCommande->setPrixTtc($prixTtc);

    //             // Associer la quantité au détail de commande
    //             $detailsCommande->setQteDetailsCommande($qteDetailsCommande);

    //              // Ajouter le détail de commande à la commande principale
    //             $commande->addDetailsCommande($detailsCommande);
    //         }        

    //         // On persiste et on flush
    //         $em->persist($commande);
    //         $em->flush();



    //         return $this->render('commande/index.html.twig', [
    //             'commandes' => 'CommandeController',
    //         ]);

    //         $session->remove('panier');

    //         //Récupérons l'utilisateur connecté
    //         //  @var User 
    //         $user =  $this->getUser();

    //         // Verifier si cet utilisateur a enregistré au moins une adresse de livraison

    //         if( \count($user->getAdresseLivraison()->toArray()) == 0 )

    //                $this->addFlash('message', 'Commande créée avec succès');
    //                 return $this->redirectToRoute('app_adresse_livraison_index');
    //     }

    // }

}
