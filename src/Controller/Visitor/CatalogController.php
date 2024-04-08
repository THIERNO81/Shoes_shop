<?php
namespace App\Controller\Visitor;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('catalog/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
}
