<?php

namespace App\Entity;

use App\Repository\FlatTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlatTypeRepository::class)]
class FlatType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'flat_type_id', targetEntity: Flat::class)]
    private Collection $flats;

    public function __construct()
    {
        $this->flats = new ArrayCollection();
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

    /**
     * @return Collection<int, Flat>
     */
    public function getFlats(): Collection
    {
        return $this->flats;
    }

    public function addFlat(Flat $flat): static
    {
        if (!$this->flats->contains($flat)) {
            $this->flats->add($flat);
            $flat->setFlatTypeId($this);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): static
    {
        if ($this->flats->removeElement($flat)) {
            // set the owning side to null (unless already changed)
            if ($flat->getFlatTypeId() === $this) {
                $flat->setFlatTypeId(null);
            }
        }

        return $this;
    }
}
