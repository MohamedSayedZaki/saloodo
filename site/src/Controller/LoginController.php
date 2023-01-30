<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_login')]
    public function index(): Response
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->redirect($this->generateUrl('app_logout'));
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
