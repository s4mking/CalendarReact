<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user","event"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user","event"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user","event"})
     */
    private $mail;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user","event"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="creator", orphanRemoval=true)
     * @Groups({"user"})
     */
    private $bookingsCreated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="subscribedUser")
     * @Groups({"user"})
     */
    private $bookingsReserved;

    public function __construct()
    {
        $this->bookingsCreated = new ArrayCollection();
        $this->bookingsReserved = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookingsCreated(): Collection
    {
        return $this->bookingsCreated;
    }

    public function addBookingsCreated(Booking $bookingsCreated): self
    {
        if (!$this->bookingsCreated->contains($bookingsCreated)) {
            $this->bookingsCreated[] = $bookingsCreated;
            $bookingsCreated->setCreator($this);
        }

        return $this;
    }

    public function removeBookingsCreated(Booking $bookingsCreated): self
    {
        if ($this->bookingsCreated->contains($bookingsCreated)) {
            $this->bookingsCreated->removeElement($bookingsCreated);
            // set the owning side to null (unless already changed)
            if ($bookingsCreated->getCreator() === $this) {
                $bookingsCreated->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookingsReserved(): Collection
    {
        return $this->bookingsReserved;
    }

    public function addBookingsReserved(Booking $bookingsReserved): self
    {
        if (!$this->bookingsReserved->contains($bookingsReserved)) {
            $this->bookingsReserved[] = $bookingsReserved;
            $bookingsReserved->setSubscribedUser($this);
        }

        return $this;
    }

    public function removeBookingsReserved(Booking $bookingsReserved): self
    {
        if ($this->bookingsReserved->contains($bookingsReserved)) {
            $this->bookingsReserved->removeElement($bookingsReserved);
            // set the owning side to null (unless already changed)
            if ($bookingsReserved->getSubscribedUser() === $this) {
                $bookingsReserved->setSubscribedUser(null);
            }
        }

        return $this;
    }
}
