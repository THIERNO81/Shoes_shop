<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;
    public const LOGIN_ROUTE = 'app_login';
    // Constructeur prenant l'interface de génération d'URL
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }
    // Méthode pour authentifier l'utilisateur
    public function authenticate(Request $request): Passport
    {
        // Récupération de l'email depuis la requête
        $email = $request->request->get('email', '');
        // Enregistrement de l'email dans la session
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        // Création d'un passeport avec les informations d'authentification
        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }
    // Méthode appelée en cas de succès d'authentification
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Récupération du chemin de redirection depuis la session
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            // Redirection vers le chemin de redirection enregistré
            return new RedirectResponse($targetPath);
        }
        // Si aucun chemin de redirection enregistré, redirection vers la page de login
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
        // Exception lancée si la redirection n'est pas définie
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }
    // Méthode pour obtenir l'URL de login
    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
