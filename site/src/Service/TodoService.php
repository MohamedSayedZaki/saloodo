<?php

namespace App\Service;

use App\Entity\Biker;
use App\Entity\BikerParcel;
use App\Entity\Parcel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoService
{

    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getTodos()
    {
        $parcelRepository = $this->doctrine->getRepository(Parcel::class);
        $parcels = $parcelRepository->findAll();

        $bikerParcelRepository = $this->doctrine->getRepository(BikerParcel::class);
        $bikerParcelsCompleted = $bikerParcelRepository->findBy(['parcel' => $parcels, "status" => "done"]);
        $bikerParcelsPending = $bikerParcelRepository->findBy(['parcel' => $parcels, "status" => "pending"]);

        $ids = array_diff(
                array_map(function($parcel) { 
                return $parcel->getId(); 
            }, $parcels),
                array_map(function($parcel) { 
                    return $parcel->getParcel()->getId(); 
            }, $bikerParcelsPending),
                array_map(function($parcel) { 
                    return $parcel->getParcel()->getId(); 
            }, $bikerParcelsCompleted)            
        );

        $unassignedParcels = $parcelRepository->findBy(['id' => $ids]);
        $unassignedParcels = $bikerParcelRepository->findBy(['parcel' => $unassignedParcels])? $bikerParcelRepository->findBy(['parcel' => $unassignedParcels]): $unassignedParcels;

        return [$parcels, $bikerParcelsCompleted, $bikerParcelsPending, $unassignedParcels];
    }

    public function createTodo($request, $user)
    {
        $requestData = json_decode($request->getContent());
        $entityManager = $this->doctrine->getManager();

        $repository = $this->doctrine->getRepository(Biker::class);
        $biker = $repository->findOneBy(['user' => $user]);

        if (!$biker) {
            throw new NotFoundHttpException('No biker found ');
        }

        $repository = $this->doctrine->getRepository(Parcel::class);
        $parcel = $repository->find($requestData->parcel);

        if (!$parcel) {
            throw new NotFoundHttpException('No parcel found for id '.$requestData->parcel);
        }

        $repository = $this->doctrine->getRepository(BikerParcel::class);
        $BikerParcel = $repository->findOneBy(['parcel' => $parcel]);

        if ($BikerParcel && $BikerParcel->getBiker()->getId() == $biker->getId()) {
            throw new NotFoundHttpException('This Parcel Assigned to you before');
        }

        $bikerParcel = new BikerParcel();
        $bikerParcel->setPickUpAt(new \DateTime());
        $bikerParcel->setDropOffAt(new \DateTime());
        $bikerParcel->setParcel($parcel);
        $bikerParcel->setBiker($biker);
        $bikerParcel->setStatus("pending");

        $entityManager->persist($bikerParcel);
        $entityManager->flush();
    }
}