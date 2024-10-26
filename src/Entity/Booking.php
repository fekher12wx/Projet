<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $BookingId = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column]
    private ?int $listingld = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'booking')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tenant $tenant = null;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\ManyToMany(targetEntity: Review::class, mappedBy: 'booking')]
    private Collection $review;

    /**
     * @var Collection<int, Appartment>
     */
    #[ORM\ManyToMany(targetEntity: Appartment::class, inversedBy: 'booking')]
    private Collection $Appartment;

    #[ORM\OneToOne(inversedBy: 'booking', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Payment $payment = null;

    public function __construct()
    {
        $this->review = new ArrayCollection();
        $this->Appartment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingId(): ?int
    {
        return $this->BookingId;
    }

    public function setBookingId(int $BookingId): static
    {
        $this->BookingId = $BookingId;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getListingld(): ?int
    {
        return $this->listingld;
    }

    public function setListingld(int $listingld): static
    {
        $this->listingld = $listingld;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function setTenant(?Tenant $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReview(): Collection
    {
        return $this->review;
    }

    public function addReview(Review $review): static
    {
        if (!$this->review->contains($review)) {
            $this->review->add($review);
            $review->addBooking($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->review->removeElement($review)) {
            $review->removeBooking($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Appartment>
     */
    public function getAppartment(): Collection
    {
        return $this->Appartment;
    }

    public function addAppartment(Appartment $appartment): static
    {
        if (!$this->Appartment->contains($appartment)) {
            $this->Appartment->add($appartment);
        }

        return $this;
    }

    public function removeAppartment(Appartment $appartment): static
    {
        $this->Appartment->removeElement($appartment);

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): static
    {
        $this->payment = $payment;

        return $this;
    }
}
