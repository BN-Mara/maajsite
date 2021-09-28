<?php

namespace App\Entity;

use App\Repository\VoteJuryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteJuryRepository::class)
 */
class VoteJury
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $prestation;

    /**
     * @ORM\Column(type="integer")
     */
    private $senique;

    /**
     * @ORM\Column(type="integer")
     */
    private $prestance;

    /**
     * @ORM\ManyToOne(targetEntity=Candidate::class, inversedBy="voteJuries")
     */
    private $candidate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $evaluationTotal;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="voteJuries")
     */
    private $jury;

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getPrestation(): ?string
    {
        return $this->prestation;
    }

    public function setPrestation(?string $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getSenique(): ?int
    {
        return $this->senique;
    }

    public function setSenique(int $senique): self
    {
        $this->senique = $senique;

        return $this;
    }

    public function getPrestance(): ?int
    {
        return $this->prestance;
    }

    public function setPrestance(int $prestance): self
    {
        $this->prestance = $prestance;

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getEvaluationTotal(): ?int
    {
        return $this->evaluationTotal;
    }

    public function setEvaluationTotal(?int $evaluationTotal): self
    {
        $this->evaluationTotal = $evaluationTotal;

        return $this;
    }

    public function getJury(): ?User
    {
        return $this->jury;
    }

    public function setJury(?User $jury): self
    {
        $this->jury = $jury;

        return $this;
    }
}
