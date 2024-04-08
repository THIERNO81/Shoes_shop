<?php
namespace App\Controller\Admin;


use App\Entity\AdresseFacturation;
use App\Form\AdresseFacturationType;
use App\Repository\AdresseFacturationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adresse/facturation')]
class AdresseFacturationController extends AbstractController
{
    #[Route('/', name: 'app_adresse_facturation_index', methods: ['GET'])]
    public function index(AdresseFacturationRepository $adresseFacturationRepository): Response
    {
        return $this->render('adresse_facturation/index.html.twig', [
            'adresse_facturations' => $adresseFacturationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adresse_facturation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresseFacturation = new AdresseFacturation();
        $form = $this->createForm(AdresseFacturationType::class, $adresseFacturation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adresseFacturation);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_facturation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse_facturation/new.html.twig', [
            'adresse_facturation' => $adresseFacturation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_facturation_show', methods: ['GET'])]
    public function show(AdresseFacturation $adresseFacturation): Response
    {
        return $this->render('adresse_facturation/show.html.twig', [
            'adresse_facturation' => $adresseFacturation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_facturation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdresseFacturation $adresseFacturation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseFacturationType::class, $adresseFacturation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_facturation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse_facturation/edit.html.twig', [
            'adresse_facturation' => $adresseFacturation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_facturation_delete', methods: ['POST'])]
    public function delete(Request $request, AdresseFacturation $adresseFacturation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $adresseFacturation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adresseFacturation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse_facturation_index', [], Response::HTTP_SEE_OTHER);
    }
}
