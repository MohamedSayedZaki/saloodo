<?php

namespace App\Entity;

use App\Repository\BikerParcelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Parcel;

#[ORM\Entity(repositoryClass: BikerParcelRepository::class)]
class BikerParcel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $pick_up_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $drop_off_at = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(targetEntity : "Parcel")]
    #[ORM\JoinColumn(nullable:false)]
    private ?Parcel $parcel;

    #[ORM\ManyToOne(targetEntity : "Biker")]
    #[ORM\JoinColumn(nullable:false)]
    private ?Biker $biker;    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPickUpAt(): ?\DateTimeInterface
    {
        return $this->pick_up_at;
    }

    public function setPickUpAt(\DateTimeInterface $pick_up_at): self
    {
        $this->pick_up_at = $pick_up_at;

        return $this;
    }

    public function getDropOffAt(): ?\DateTimeInterface
    {
        return $this->drop_off_at;
    }

    public function setDropOffAt(\DateTimeInterface $drop_off_at): self
    {
        $this->drop_off_at = $drop_off_at;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getParcel(): ?Parcel
    {
        return $this->parcel;
    }

    public function setParcel(?Parcel $parcel):Self
    {
        $this->parcel = $parcel;

        return $this;
    }

    public function getBiker(): ?Biker
    {
        return $this->biker;
    }

    public function setBiker(?Biker $biker):Self
    {
        $this->biker = $biker;

        return $this;
    }    
}
