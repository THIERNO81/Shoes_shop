<?php
namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\Common\Util\Debug;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
public function index(SessionInterface $session, ProduitRepository $produitRepository)
{
    $panier = $session->get('panier', []);
    $data = [];
    $totalHT = 0;

    foreach ($panier as $id => $quantity) {
        $produit = $produitRepository->find($id);

        if ($produit !== null) {
            $prixProduit = $produit->getPrixProduit();
            $sousTotal = $prixProduit * $quantity;

            $data[] = [
                'produit' => $produit,
                'quantity' => $quantity,
                'sousTotal' => $sousTotal
            ];

            $totalHT += $sousTotal;
        }
    }

    $tva = $totalHT * 0.20; // Calcul de la TVA (taux de 20%)
    $totalTTC = $totalHT + $tva; // Calcul du total TTC

    return $this->render('panier/index.html.twig', [
        'data' => $data,
        'totalHT' => $totalHT,
        'tva' => $tva,
        'totalTTC' => $totalTTC
    ]);
}


    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session)
    {
        // On récupère l'id du produit
        $id = $produit->getId();

        // On récupère le panier existant depuis la session
        $panier = $session->get('panier', []);

        // On vérifie si le produit est déjà dans le panier
        if(isset($panier[$id])) {
            // Si oui, on incrémente la quantité
            $panier[$id]++;
        } else {
            // Sinon, on ajoute le produit avec une quantité de 1
            $panier[$id] = 1;
        }

        
        

        // On met à jour le panier dans la session
        $session->set('panier', $panier);

        // On redirige vers la page du panier
        return $this->redirectToRoute('panier_index');
    }
    
    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session)
    {
        // On récupère l'id du produit
        $id = $produit->getId();

        // On récupère le panier existant
        $panier = $session->get('panier', []);

        // On retire le produit du panier s'il n'y a qu'1 exemplaire sinon on décrémente sa quantité
        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);
        
        // On redirige vers la page du panier
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session)
    {
        // On récupère l'id du produit
        $id = $produit->getId();

        // On récupère le panier existant
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        
        // On redirige vers la page du panier
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->redirectToRoute('panier_index');
    }
}
