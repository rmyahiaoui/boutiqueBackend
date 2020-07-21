<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouleurRepository::class)
 */
class Couleur
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Chaussure::class, mappedBy="couleur")
     */
    private $chaussure;

    public function __construct()
    {
        $this->chaussure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Chaussure[]
     */
    public function getChaussure(): Collection
    {
        return $this->chaussure;
    }

    public function addChaussure(Chaussure $chaussure): self
    {
        if (!$this->chaussure->contains($chaussure)) {
            $this->chaussure[] = $chaussure;
            $chaussure->setCouleur($this);
        }

        return $this;
    }

    public function removeChaussure(Chaussure $chaussure): self
    {
        if ($this->chaussure->contains($chaussure)) {
            $this->chaussure->removeElement($chaussure);
            // set the owning side to null (unless already changed)
            if ($chaussure->getCouleur() === $this) {
                $chaussure->setCouleur(null);
            }
        }

        return $this;
    }
}
