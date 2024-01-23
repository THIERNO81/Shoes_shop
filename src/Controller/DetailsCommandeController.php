<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsCommandeController extends AbstractController
{
    #[Route('/details/commande', name: 'app_details_commande')]
    public function index(): Response
    {
        return $this->render('details_commande/index.html.twig', [
            'controller_name' => 'DetailsCommandeController',
        ]);
    }
}
