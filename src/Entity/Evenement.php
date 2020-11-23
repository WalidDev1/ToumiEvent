<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToOne(targetEntity=Date::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Services::class)
     */
    private $Services;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="evenement")
     */
    private $media;

    /**
     * @ORM\OneToOne(targetEntity=Date::class, cascade={"persist", "remove"})
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;


    public function __construct()
    {
        $this->Services = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDate(): ?Date
    {
        return $this->date;
    }

    public function setDate(Date $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->Services;
    }

    public function addService(Services $service): self
    {
        if (!$this->Services->contains($service)) {
            $this->Services[] = $service;
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->Services->contains($service)) {
            $this->Services->removeElement($service);
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setEvenement($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getEvenement() === $this) {
                $medium->setEvenement(null);
            }
        }

        return $this;
    }

    public function getDateEnd(): ?Date
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?Date $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

}
