<?php

namespace App\Entity;

use App\Repository\ParcelRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\BikerParcel;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ParcelRepository::class)]
class Parcel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $pick_up = null;

    #[ORM\Column(length: 255)]
    private ?string $drop_off = null;

    #[ORM\ManyToOne(inversedBy: 'parcels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sender $sender = null;

    #[ORM\OneToMany(targetEntity: "BikerParcel", mappedBy: 'parcel')]
    private $theBikerParcel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPick_Up(): ?string
    {
        return $this->pick_up;
    }

    public function setPickUp(string $pick_up): self
    {
        $this->pick_up = $pick_up;

        return $this;
    }

    public function getDrop_Off(): ?string
    {
        return $this->drop_off;
    }

    public function setDropOff(string $drop_off): self
    {
        $this->drop_off = $drop_off;

        return $this;
    }

    public function getSender(): ?Sender
    {
        return $this->sender;
    }

    public function setSender(?Sender $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getTheBikerParcel():?Collection
    {
        return $this->theBikerParcel;
    }
}
