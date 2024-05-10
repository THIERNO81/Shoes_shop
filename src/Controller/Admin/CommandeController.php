<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Entity\DetailsCommande;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commande', name: 'app_commande_')]
class CommandeController extends AbstractController
{
    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepository, EntityManagerInterface $em): Response
    {

         //Récupérons l'utilisateur connecté
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
                
                // Maintenant, vous pouvez accéder aux méthodes de l'utilisateur en toute sécurité
                $adresseLivraison = $user->getAdresseLivraison();
                
                if (!$adresseLivraison) {
                    $this->addFlash('success', "Vous devez enregistrer au moins une adresse de livraison avant de passer votre commande.");
                    return $this->redirectToRoute('app_adresse_livraison_index');
                }
                


                       
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);
     
        if ($panier === []) {
                        $this->addFlash('message', 'Votre panier est vide');
                        return $this->redirectToRoute('app_welcome');
                         }

        //le panier n'est pas vide, on crée la commande
        $commande = new commande();
        $NomProduit = "Nom du produit";
       

        //on remplit la commande
        $commande->setUser($this->getUser());
        $commande->setUserId((int)uniqid());

        // on parcourt le panier pour créer les détails de commande
        foreach ($panier as $itemId => $qteDetailsCommande) {
            $detailsCommande = new DetailsCommande();
           
        //on va chercher le produit
        $itemId = (string) $itemId;
        $produit = $produitRepository->find($itemId);
        
        $prixTtc = $produit->getPrixProduit();

        

            // Récupérer le nom du produit et l'associer au détail de commande
            $detailsCommande->setNomProduit($NomProduit);

            // Récupérer le prix TTC du produit et l'associer au détail de commande
            $detailsCommande->setPrixTtc($prixTtc);

            // Associer la quantité au détail de commande
            $detailsCommande->setQteDetailsCommande($qteDetailsCommande);
           
             // Ajouter le détail de commande à la commande principale
            $commande->addDetailsCommande($detailsCommande);
        }        
        
        // On persiste et on flush
        $em->persist($commande);
        $em->flush();

    
        return $this->render('commande/index.html.twig', [
            'commandes' => 'CommandeController',
        ]);

        $session->remove('panier');
                // //Récupérons l'utilisateur connecté
                // /**
                //  * @var User 
                // */  
                // $user =  $this->getUser();
                // $user->getAdresseLivraison();
                // // Verifier si cet utilisateur a enregistré au moins une adresse de livraison
             
                // if( \count($user->getAdresseLivraison()->toArray()) == 0 )
                       
                    //    $this->addFlash('message', 'Commande créée avec succès');
                    //     return $this->redirectToRoute('app_adresse_livraison_index');
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

