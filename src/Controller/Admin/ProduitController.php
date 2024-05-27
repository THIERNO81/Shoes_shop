<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/produit')]
class ProduitController extends AbstractController
{
    #[Route('/index', name: 'admin_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        // Récupère tous les produits depuis le repository et les passe au template
        return $this->render('admin/produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Crée un nouveau produit
        $produit = new Produit();
        
        // Crée le formulaire pour le produit
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        // Vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Persiste le produit en base de données
            $entityManager->persist($produit);
            $entityManager->flush();

            // Redirige vers la liste des produits
            return $this->redirectToRoute('admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        // Passe le formulaire et le produit au template
        return $this->render('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'admin_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        // Affiche les détails d'un produit
        return $this->render('admin/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_produit_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        return $this->redirectToRoute('admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('admin/produit/edit.html.twig', [
        'produit' => $produit,
        'formProduit' => $form->createView(), // Assurez-vous que le formulaire est passé ici
    ]);
}


    #[Route('/{id}', name: 'admin_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        // Valide le jeton CSRF avant de supprimer le produit
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            // Supprime le produit de la base de données
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        // Redirige vers la liste des produits
        return $this->redirectToRoute('admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/fiche', name: 'admin_produit_fiche', methods: ['GET'])]
    public function fiche(Request $request, Produit $produit): Response
    {
        // Affiche une fiche détaillée d'un produit
        return $this->render('admin/produit/fiche.html.twig', [
            'produit' => $produit,
        ]);
    }
}

