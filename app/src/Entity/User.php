<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $data;

    private string $firstname;

    private string $lastname;

    private string $address;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): ?self
    {
        $this->data = $data;
        return $this;
    }

    public function getFisrtName(): ?string
    {
        return $this->firstname;
    }

    public function setFisrtName(string $firstname): ?self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastname;
    }

    public function setLastName(string $lastname): ?self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): ?self
    {
        $this->address = $address;
        return $this;
    }
}
