<?php
namespace App\Controller\Visitor;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // Sécurisation de la page d'inscription : si l'utilisateur est déjà authentifié, redirection vers la page d'accueil
        if ($this->getUser()) {
            return $this->redirectToRoute('app_welcome');
        }
        // Création d'une nouvelle instance de l'entité User
        $user = new User();
        // Création du formulaire d'inscription et association avec l'entité User
        $form = $this->createForm(RegistrationFormType::class, $user);
        // Traitement de la requête HTTP et liaison des données du formulaire avec l'entité User
        $form->handleRequest($request);
        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Encodage du mot de passe avant de le stocker en base de données
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            // Persistance de l'utilisateur en base de données
            $entityManager->persist($user);
            // Enregistrement des modifications en base de données
            $entityManager->flush();
            // Ajout d'un message flash pour informer l'utilisateur que son inscription a été validée
            $this->addFlash('success', 'Votre inscription a été validée');
            // Redirection vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Rendu de la vue du formulaire d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

