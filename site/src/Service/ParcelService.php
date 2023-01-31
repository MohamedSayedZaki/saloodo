<?php

namespace App\Service;

use App\Entity\Parcel;
use App\Entity\Sender;
use Doctrine\Persistence\ManagerRegistry;

class ParcelService
{

    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getSenderParcels($user)
    {
        $repository = $this->doctrine->getRepository(Sender::class);
        $sender = $repository->findOneBy(['user' => $user]);

        $repository = $this->doctrine->getRepository(Parcel::class);
        return $repository->findSenderParcels($sender);
    }

    public function createParcel($request, $user)
    {
        $postData = json_decode($request->getContent());
        
        $entityManager = $this->doctrine->getManager();
        
        $repository = $this->doctrine->getRepository(Sender::class);
        $sender = $repository->findOneBy(['user' => $user]);
        
        $parcel = new Parcel();
        $parcel->setTitle($postData->title);
        $parcel->setPickUp($postData->pick_up);
        $parcel->setDropOff($postData->drop_off);
        $parcel->setSender($sender);

        $entityManager->persist($parcel);
        $entityManager->flush();
    }
}