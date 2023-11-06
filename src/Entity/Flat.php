<?php

namespace App\Entity;

use App\Repository\FlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlatRepository::class)]
class Flat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $rooms_count = null;

    #[ORM\Column(nullable: true)]
    private ?int $square = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $pets = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timestamps = null;

    #[ORM\ManyToMany(targetEntity: Party::class, mappedBy: 'flat_id')]
    private Collection $party_id;

    #[ORM\ManyToOne(inversedBy: 'flats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FlatType $flat_type_id = null;

    public function __construct()
    {
        $this->party_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getRoomsCount(): ?int
    {
        return $this->rooms_count;
    }

    public function setRoomsCount(int $rooms_count): static
    {
        $this->rooms_count = $rooms_count;

        return $this;
    }

    public function getSquare(): ?int
    {
        return $this->square;
    }

    public function setSquare(?int $square): static
    {
        $this->square = $square;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isPets(): ?bool
    {
        return $this->pets;
    }

    public function setPets(?bool $pets): static
    {
        $this->pets = $pets;

        return $this;
    }

    public function getTimestamps(): ?\DateTimeInterface
    {
        return $this->timestamps;
    }

    public function setTimestamps(\DateTimeInterface $timestamps): static
    {
        $this->timestamps = $timestamps;

        return $this;
    }

    /**
     * @return Collection<int, Party>
     */
    public function getPartyId(): Collection
    {
        return $this->party_id;
    }

    public function addPartyId(Party $partyId): static
    {
        if (!$this->party_id->contains($partyId)) {
            $this->party_id->add($partyId);
            $partyId->addFlatId($this);
        }

        return $this;
    }

    public function removePartyId(Party $partyId): static
    {
        if ($this->party_id->removeElement($partyId)) {
            $partyId->removeFlatId($this);
        }

        return $this;
    }

    public function getFlatTypeId(): ?FlatType
    {
        return $this->flat_type_id;
    }

    public function setFlatTypeId(?FlatType $flat_type_id): static
    {
        $this->flat_type_id = $flat_type_id;

        return $this;
    }
}
