<?php

namespace App\Entity;

use App\Model\TimestampedInterface;
use App\Repository\PersonnelsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonnelsRepository::class)]
class Personnels implements TimestampedInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Noms $nom = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prenoms $prenom = null;

    #[ORM\Column(length: 8)]
    private ?string $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank()]
    private ?LieuNaissances $lieuNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $telephone = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professions $profession = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NiveauEtudes $niveauEtude = null;

    #[ORM\ManyToMany(targetEntity: Specialites::class, inversedBy: 'personnels')]
    private Collection $specialite;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Departements $departement = null;

    #[ORM\Column(length: 12)]
    private ?string $situationMatrimoniale = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbEnfants = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\ManyToMany(targetEntity: Etablissements::class, inversedBy: 'personnels')]
    private Collection $etablissement;

    #[ORM\OneToMany(mappedBy: 'personnels', targetEntity: Users::class)]
    private Collection $user;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'personnel', targetEntity: Contrats::class)]
    private Collection $contrats;

    #[ORM\Column]
    private ?bool $isActif = true;

    public function __construct()
    {
        $this->specialite = new ArrayCollection();
        $this->etablissement = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->contrats = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->fullName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?Noms
    {
        return $this->nom;
    }

    public function setNom(?Noms $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?Prenoms
    {
        return $this->prenom;
    }

    public function setPrenom(?Prenoms $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?LieuNaissances
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?LieuNaissances $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getProfession(): ?Professions
    {
        return $this->profession;
    }

    public function setProfession(?Professions $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getNiveauEtude(): ?NiveauEtudes
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(?NiveauEtudes $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    /**
     * @return Collection<int, Specialites>
     */
    public function getSpecialite(): Collection
    {
        return $this->specialite;
    }

    public function addSpecialite(Specialites $specialite): self
    {
        if (!$this->specialite->contains($specialite)) {
            $this->specialite->add($specialite);
        }

        return $this;
    }

    public function removeSpecialite(Specialites $specialite): self
    {
        $this->specialite->removeElement($specialite);

        return $this;
    }

    public function getDepartement(): ?Departements
    {
        return $this->departement;
    }

    public function setDepartement(?Departements $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getSituationMatrimoniale()
    {
        return $this->situationMatrimoniale;
    }

    public function setSituationMatrimoniale($situationMatrimoniale): self
    {
        $this->situationMatrimoniale = $situationMatrimoniale;

        return $this;
    }

    public function getNbEnfants(): ?int
    {
        return $this->nbEnfants;
    }

    public function setNbEnfants(?int $nbEnfants): self
    {
        $this->nbEnfants = $nbEnfants;

        return $this;
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

    /**
     * @return Collection<int, Etablissements>
     */
    public function getEtablissement(): Collection
    {
        return $this->etablissement;
    }

    public function addEtablissement(Etablissements $etablissement): self
    {
        if (!$this->etablissement->contains($etablissement)) {
            $this->etablissement->add($etablissement);
        }

        return $this;
    }

    public function removeEtablissement(Etablissements $etablissement): self
    {
        $this->etablissement->removeElement($etablissement);

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setPersonnels($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPersonnels() === $this) {
                $user->setPersonnels(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Contrats>
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrats $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats->add($contrat);
            $contrat->setPersonnel($this);
        }

        return $this;
    }

    public function removeContrat(Contrats $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getPersonnel() === $this) {
                $contrat->setPersonnel(null);
            }
        }

        return $this;
    }

    public function isIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }
}