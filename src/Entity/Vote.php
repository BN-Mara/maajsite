<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity=Candidate::class, inversedBy="votes")
     */
    private $candidate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    /**
     * @ORM\ManyToOne(targetEntity=Subscription::class, inversedBy="votes")
     */
    private $subscription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfVote;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(?\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getNumberOfVote(): ?int
    {
        return $this->numberOfVote;
    }

    public function setNumberOfVote(?int $numberOfVote): self
    {
        $this->numberOfVote = $numberOfVote;

        return $this;
    }
}
