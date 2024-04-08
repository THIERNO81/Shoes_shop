<?php
namespace App\Controller\Admin;


use App\Entity\DetailsCommande;
use App\Form\DetailsCommandeType;
use App\Repository\DetailsCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/details/commande')]
class DetailsCommandeController extends AbstractController
{
    #[Route('/', name: 'app_details_commande_index', methods: ['GET'])]
    public function index(DetailsCommandeRepository $detailsCommandeRepository): Response
    {
        return $this->render('details_commande/index.html.twig', [
            'details_commandes' => $detailsCommandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_details_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detailsCommande = new DetailsCommande();
        $form = $this->createForm(DetailsCommandeType::class, $detailsCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detailsCommande);
            $entityManager->flush();

            return $this->redirectToRoute('app_details_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('details_commande/new.html.twig', [
            'details_commande' => $detailsCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_commande_show', methods: ['GET'])]
    public function show(DetailsCommande $detailsCommande): Response
    {
        return $this->render('details_commande/show.html.twig', [
            'details_commande' => $detailsCommande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_details_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailsCommande $detailsCommande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailsCommandeType::class, $detailsCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_details_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('details_commande/edit.html.twig', [
            'details_commande' => $detailsCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_commande_delete', methods: ['POST'])]
    public function delete(Request $request, DetailsCommande $detailsCommande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailsCommande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($detailsCommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_details_commande_index', [], Response::HTTP_SEE_OTHER);
    }
}
