<?php

namespace App\Controller\Visitor;

use App\Entity\Produit; // Ajout de l'importation de l'entité Produit
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {

       
        $produits = $produitRepository->findAll();

        return $this->render('catalog/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/{id}/fiche', name: 'produit_fiche', methods: ['GET'])]
    public function fiche(Request $request, Produit $produit): Response
    {
        return $this->render('catalog/fiche.html.twig', [
            'produit' => $produit,
        ]);
    }
    
}
