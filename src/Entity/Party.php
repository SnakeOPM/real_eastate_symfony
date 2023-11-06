<?php

namespace App\Entity;

use App\Repository\PartyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartyRepository::class)]
class Party
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $invite_token = null;

    #[ORM\ManyToMany(targetEntity: Flat::class, inversedBy: 'party_id')]
    private Collection $flat_id;

    #[ORM\OneToMany(mappedBy: 'party_id', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->flat_id = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getInviteToken(): ?string
    {
        return $this->invite_token;
    }

    public function setInviteToken(string $invite_token): static
    {
        $this->invite_token = $invite_token;

        return $this;
    }

    /**
     * @return Collection<int, Flat>
     */
    public function getFlatId(): Collection
    {
        return $this->flat_id;
    }

    public function addFlatId(Flat $flatId): static
    {
        if (!$this->flat_id->contains($flatId)) {
            $this->flat_id->add($flatId);
        }

        return $this;
    }

    public function removeFlatId(Flat $flatId): static
    {
        $this->flat_id->removeElement($flatId);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setPartyId($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPartyId() === $this) {
                $user->setPartyId(null);
            }
        }

        return $this;
    }
}
