<?php

namespace App\Entity;

use App\Entity\Traits\BlameableTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    use TimestampableTrait;
    use BlameableTrait;

    const HORSE_POWER = [
        '2' => '2',
        '50' => '50',
        '60' => '60',
        '100' => '100',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     * @Gedmo\Slug(fields={"model"})
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $horsePower;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $matriculation;

    /**
     * @ORM\Column(type="date")
     */
    private $matriculationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity=Customer::class, inversedBy="cars")
     */
    private $owners;

    public function __construct()
    {
        $this->owners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return Car
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getHorsePower(): ?int
    {
        return $this->horsePower;
    }

    public function setHorsePower(?int $horsePower): self
    {
        $this->horsePower = $horsePower;

        return $this;
    }

    public function getMatriculation(): ?string
    {
        return $this->matriculation;
    }

    public function setMatriculation(string $matriculation): self
    {
        $this->matriculation = $matriculation;

        return $this;
    }

    public function getMatriculationDate(): ?\DateTimeInterface
    {
        return $this->matriculationDate;
    }

    public function setMatriculationDate(?\DateTimeInterface $matriculationDate): self
    {
        $this->matriculationDate = $matriculationDate;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getOwners(): Collection
    {
        return $this->owners;
    }

    public function addOwner(Customer $owners): self
    {
        if (!$this->owners->contains($owners)) {
            $this->owners[] = $owners;
        }

        return $this;
    }

    public function removeOwner(Customer $owners): self
    {
        $this->owners->removeElement($owners);

        return $this;
    }
}
