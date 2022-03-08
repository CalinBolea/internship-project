<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    public string $password = '';

    public string $cnp = '';

    public string $email = '';

    public string $firstName = '';

    public string $lastName = '';

    private Collection $roles;

    /**
     * @ORM\ManyToMany(targetEntity="Programme", mappedBy="customers")
     */
    private Collection $programmes;

    /**
     * @param Collection $programmes
     */
    public function __construct()
    {
        $this->programmes = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setRoles(Collection $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function setProgrammes(Collection $programmes): self
    {
        $this->programmes = $programmes;

        return $this;
    }

    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if ($this->programmes->contains($programme)) {
            return $this;
        }

        $this->programmes->add($programme);
        $programme->addCustomer($this);

        return $this;
    }
}