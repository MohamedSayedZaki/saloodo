<?php

namespace App\Controller;

use App\Service\TodoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoController extends AbstractController
{
    private $security;
    private $todoService;
    public function __construct(Security $security, TodoService $todoService)
    {
        $this->security = $security;
        $this->todoService = $todoService;
    }

    #[Route('/api/todo', name: 'app_todo')]
    public function index()
    {
        [$parcels, $bikerParcelsCompleted, $bikerParcelsPending, $unassignedParcels] = $this->todoService->getTodos();

        return $this->render('todo/index.html.twig', [
            'parcels' => $parcels,
            'bikerParcelsCompleted' => $bikerParcelsCompleted,
            'bikerParcelsPending' => $bikerParcelsPending,
            'unassignedParcels' => $unassignedParcels
        ]);
    }

    #[Route('/api/todo/create', name: 'app_create_todo', methods: ['POST'])]
    public function create(Request $request):Response
    {
        try {
            $user = $this->security->getUser();
            $this->todoService->createTodo($request, $user);

            return new Response("Parcel Assigned TO You Successfully", 200);      
        } catch (NotFoundHttpException $exception) {
            return new Response($exception->getMessage(), 200);      
        }
    }  
}
