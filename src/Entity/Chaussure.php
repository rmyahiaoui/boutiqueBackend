<?php

namespace App\Entity;

use App\Repository\ChaussureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ChaussureRepository::class)
 */
class Chaussure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("group1")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("group1")
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("group1")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("group1")
     */
    private $matiere;

    /**
     * @ORM\Column(type="float")
     * @Groups("group1")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("group1")
     */
    private $date_vente;

    /**
     * @ORM\ManyToOne(targetEntity=Couleur::class, inversedBy="chaussure")
     */
    private $couleur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(Couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->date_vente;
    }

    public function setDateVente(\DateTimeInterface $date_vente): self
    {
        $this->date_vente = $date_vente;

        return $this;
    }
}
