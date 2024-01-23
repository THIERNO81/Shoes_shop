<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseLivraisonController extends AbstractController
{
    #[Route('/adresse/livraison', name: 'app_adresse_livraison')]
    public function index(): Response
    {
        return $this->render('adresse_livraison/index.html.twig', [
            'controller_name' => 'AdresseLivraisonController',
        ]);
    }
}
