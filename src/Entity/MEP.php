<?php

namespace App\Entity;

use App\Repository\MEPRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MEPRepository::class)]
class MEP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $politicalGroup = null;

    #[ORM\Column]
    private ?int $idNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalPoliticalGroup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPoliticalGroup(): ?string
    {
        return $this->politicalGroup;
    }

    public function setPoliticalGroup(string $politicalGroup): self
    {
        $this->politicalGroup = $politicalGroup;

        return $this;
    }

    public function getIdNumber(): ?int
    {
        return $this->idNumber;
    }

    public function setIdNumber(int $idNumber): self
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    public function getNationalPoliticalGroup(): ?string
    {
        return $this->nationalPoliticalGroup;
    }

    public function setNationalPoliticalGroup(string $nationalPoliticalGroup): self
    {
        $this->nationalPoliticalGroup = $nationalPoliticalGroup;

        return $this;
    }
}
