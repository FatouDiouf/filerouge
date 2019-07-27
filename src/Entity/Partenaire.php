<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $raisonsociale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=255)
     */
    private $statut;
=======
     * @ORM\OneToMany(targetEntity="App\Entity\Users", mappedBy="partenaire")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
>>>>>>> d03c8b806dd2f50939d11701c1a34fa7009bcb6f

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNinea(): ?int
    {
        return $this->ninea;
    }

    public function setNinea(int $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getRaisonsociale(): ?string
    {
        return $this->raisonsociale;
    }

    public function setRaisonsociale(string $raisonsociale): self
    {
        $this->raisonsociale = $raisonsociale;

        return $this;
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

<<<<<<< HEAD
    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
=======
    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setPartenaire($this);
        }
>>>>>>> d03c8b806dd2f50939d11701c1a34fa7009bcb6f

        return $this;
    }

<<<<<<< HEAD
    

=======
    public function removeUser(Users $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getPartenaire() === $this) {
                $user->setPartenaire(null);
            }
        }

        return $this;
    }
>>>>>>> d03c8b806dd2f50939d11701c1a34fa7009bcb6f
}
