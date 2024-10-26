<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OwnerRepository::class)]
class Owner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Appartment>
     */
    #[ORM\OneToMany(targetEntity: Appartment::class, mappedBy: 'owner')]
    private Collection $appartment;

    public function __construct()
    {
        $this->appartment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Appartment>
     */
    public function getAppartment(): Collection
    {
        return $this->appartment;
    }

    public function addAppartment(Appartment $appartment): static
    {
        if (!$this->appartment->contains($appartment)) {
            $this->appartment->add($appartment);
            $appartment->setOwner($this);
        }

        return $this;
    }

    public function removeAppartment(Appartment $appartment): static
    {
        if ($this->appartment->removeElement($appartment)) {
            // set the owning side to null (unless already changed)
            if ($appartment->getOwner() === $this) {
                $appartment->setOwner(null);
            }
        }

        return $this;
    }
}
