<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseFacturationController extends AbstractController
{
    #[Route('/adresse/facturation', name: 'app_adresse_facturation')]
    public function index(): Response
    {
        return $this->render('adresse_facturation/index.html.twig', [
            'controller_name' => 'AdresseFacturationController',
        ]);
    }
}
