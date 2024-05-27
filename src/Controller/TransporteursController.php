<?php

namespace App\Controller;

use App\Entity\Transporteurs;
use App\Form\TransporteursType;
use App\Repository\TransporteursRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/transporteurs')]
class TransporteursController extends AbstractController
{
    #[Route('/', name: 'app_transporteurs_index', methods: ['GET'])]
    public function index(TransporteursRepository $transporteursRepository): Response
    {
        $transporteurs = $transporteursRepository->findAll();
        $form = $this->createForm(TransporteursType::class, $transporteurs, [
            'method' => 'PUT'
        ]);
        return $this->render('transporteurs/index.html.twig', [
            'transporteurs' => $transporteurs,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/new', name: 'app_transporteurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $transporteur = new Transporteurs();
        $form = $this->createForm(TransporteursType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transporteur);
            $entityManager->flush();
            return $this->redirectToRoute('app_transporteurs_index');
        }
        return $this->renderForm('transporteurs/new.html.twig', [
            'transporteur' => $transporteur,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_transporteurs_show', methods: ['GET'])]
    public function show(Transporteurs $transporteur): Response
    {
        return $this->render('transporteurs/show.html.twig', [
            'transporteur' => $transporteur,
        ]);
    }
    #[Route('/{id}/edit', name: 'app_transporteurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transporteurs $transporteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TransporteursType::class, $transporteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $transporteur->setUpdatedAt(new DateTimeImmutable());
            try {
                $entityManager->persist($transporteur);
                $entityManager->flush();

                $this->addFlash("success", 'Le livreur a été modifié.');

                return $this->redirectToRoute('app_transporteurs_index');
            } catch (\Exception $e) {
                $this->addFlash("error", 'Une erreur est survenue lors de la modification du livreur.');
                // Enregistrement facultatif de l'erreur
                // $this->logger->error('Erreur lors de la modification du livreur : ' . $e->getMessage());
            }
        } else {
            $this->addFlash("error", 'Le formulaire n\'est pas valide. Veuillez corriger les erreurs.');
        }

        return $this->renderForm('transporteurs/edit.html.twig', [
            'transporteur' => $transporteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transporteurs_delete', methods: ['POST'])]
    public function delete(Request $request, Transporteurs $transporteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transporteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($transporteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transporteurs_index');
    }
}

