<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilControlerController extends AbstractController
{
    #[Route('/profil/controler', name: 'app_profil_controler')]
    public function index(): Response
    {
        return $this->render('profil_controler/profile.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
}
