<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
//Penser a mettre 2 onetomany customer et creator certainement rajouter un state aussi
/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     * @Groups({"event"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"event"})
     */
    private $beginAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"event"})
     */
    private $endAt = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookingsCreated")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"event"})
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookingsReserved")
     * @Groups({"event"})
     */
    private $subscribedUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTimeInterface $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt = null): self
    {
        $this->endAt = $endAt;

        return $this;
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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getSubscribedUser(): ?User
    {
        return $this->subscribedUser;
    }

    public function setSubscribedUser(?User $subscribedUser): self
    {
        $this->subscribedUser = $subscribedUser;

        return $this;
    }
}
