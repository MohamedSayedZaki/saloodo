<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/api/home', name: 'app_home')]
    public function index(): RedirectResponse
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('ROLE_SENDER')) {
            return new RedirectResponse("/api/parcel/index");
        }else{
            return new RedirectResponse("/api/todo");
        }
    }
}
