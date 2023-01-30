<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route("/logout", name : "app_logout", methods : ["GET"])]
    public function logout()
    {
        session_destroy();
        return $this->redirect($this->generateUrl('app_login'));
    }
}