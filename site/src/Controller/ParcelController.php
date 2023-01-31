<?php

namespace App\Controller;

use App\Service\ParcelService;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ParcelController extends AbstractController
{
    private $security;
    private $parcelService;
    public function __construct(Security $security, ParcelService $parcelService)
    {
        $this->security = $security;
        $this->parcelService = $parcelService;
    }

    #[Route('/api/parcel/index', name: 'app_parcel')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        $parcels = $this->parcelService->getSenderParcels($user);
        // dd($parcels[0]->getTheBikerParcel());
        return $this->render('parcel/index.html.twig', [
            'parcels' => $parcels,
        ]);
    }

    #[Route('/api/parcel/add', name: 'app_add_parcel', methods: ['POST','GET'])]
    public function store(Request $request, ManagerRegistry $doctrine)
    {
        try {
            if($request->getMethod() == "POST"){    
                $user = $this->security->getUser();
                $this->parcelService->createParcel($request, $user);

                return new Response(200);
            }
            return $this->render('parcel/new.html.twig', [
                'controller_name' => 'ParcelController',
            ]);
        } catch (Exception | NotFoundHttpException $exception) {
            return new Response($exception->getMessage(), 200);      
        }
    }  
}
