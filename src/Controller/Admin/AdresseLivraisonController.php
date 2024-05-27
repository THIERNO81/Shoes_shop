<?php

namespace App\Controller\Admin;
use App\Entity\AdresseLivraison;
use App\Form\AdresseLivraisonType;
use App\Repository\AdresseLivraisonRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
#[Route('/adresse/livraison')]
class AdresseLivraisonController extends AbstractController
{
    // Méthode pour afficher toutes les adresses de livraison
    #[Route('/', name: 'app_adresse_livraison_index', methods: ['GET'])]
    public function index(AdresseLivraisonRepository $adresseLivraisonRepository): Response
    {
        return $this->render('adresse_livraison/index.html.twig', [
            'adresse_livraisons' => $adresseLivraisonRepository->findAll(),
        ]);
    }
    // Méthode pour créer une nouvelle adresse de livraison
    #[Route('/new', name: 'app_adresse_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresseLivraison = new AdresseLivraison();
        $form = $this->createForm(AdresseLivraisonType::class, $adresseLivraison);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Définition de la date de création et de mise à jour
            $adresseLivraison->setCreatedAt(new DateTimeImmutable());
            $adresseLivraison->setUpdatedAt(new DateTimeImmutable());
            $adresseLivraison->setUser($this->getUser());
            $entityManager->persist($adresseLivraison);
            $entityManager->flush();
            $this->addFlash("success", "L'adresse a été ajoutée avec succès.");
            return $this->redirectToRoute('app_adresse_livraison_index');
        }
        return $this->render('adresse_livraison/new.html.twig', [
            'adresse_livraison' => $adresseLivraison,
            'form' => $form->createView(), // Retourner le formulaire pour le template
        ]);
    }
    // Méthode pour afficher une adresse de livraison spécifique
    #[Route('/{id}', name: 'app_adresse_livraison_show', methods: ['GET'])]
    public function show(AdresseLivraison $adresseLivraison): Response
    {
        return $this->render('adresse_livraison/show.html.twig', [
            'adresse_livraison' => $adresseLivraison,
        ]);
    }
    // Méthode pour éditer une adresse de livraison existante
    #[Route('/{id}/edit', name: 'app_adresse_livraison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdresseLivraison $adresseLivraison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseLivraisonType::class, $adresseLivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_livraison_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('adresse_livraison/edit.html.twig', [
            'adresse_livraison' => $adresseLivraison,
            'form' => $form,
        ]);
    }

    // Méthode pour supprimer une adresse de livraison
    #[Route('/{id}', name: 'app_adresse_livraison_delete', methods: ['POST'])]
    public function delete(Request $request, AdresseLivraison $adresseLivraison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $adresseLivraison->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adresseLivraison);
            $entityManager->flush();

            $this->addFlash("success", "L'adresse a été supprimée avec succès.");
        }

        return $this->redirectToRoute('app_adresse_livraison_index', [], Response::HTTP_SEE_OTHER);
    }
}
