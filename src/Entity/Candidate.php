<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CandidateRepository::class)
 */
class Candidate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="candidate")
     */
    private $votes;

    /**
     * @ORM\OneToOne(targetEntity=SonataMediaMedia::class, inversedBy="candidate", cascade={"persist", "remove"})
     */
    private $coverImage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;

     /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\CandidateHasMedia",
     *     mappedBy="candidate", cascade={"persist"}, orphanRemoval=true
     * )
     * @ORM\OrderBy({"position"="ASC"})
     *
     * @var CandidateHasMedia[]|Collection
     * 
     */
    protected $candidateHasMedias;

    /**
     * @ORM\OneToMany(targetEntity=VoteJury::class, mappedBy="candidate")
     */
    private $voteJuries;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
        $this->candidateHasMedias = new ArrayCollection();
        $this->candidateHasMedia2s = new ArrayCollection();
        $this->voteJuries = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->firstname."".$this->lastname ?: '-';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setCandidate($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getCandidate() === $this) {
                $vote->setCandidate(null);
            }
        }

        return $this;
    }

    public function getCoverImage(): ?SonataMediaMedia
    {
        return $this->coverImage;
    }

    public function setCoverImage(?SonataMediaMedia $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }
    public function setCandidateHasMedias($candidateHasMedias)
    {
        $this->candidateHasMedias = new ArrayCollection();

        foreach ($candidateHasMedias as $candidateHasMedia) {
            $this->addCandidateHasMedia($candidateHasMedia);
        }
    }

    public function getCandidateHasMedias()
    {
        return $this->candidateHasMedias;
    }

    public function addCandidateHasMedia(CandidateHasMedia $candidateHasMedia)
    {
        $candidateHasMedia->setCandidate($this);

        $this->candidateHasMedias[] = $candidateHasMedia;
    }

    public function removeCandidateHasMedia(CandidateHasMedia $candidateHasMedia)
    {
        $this->candidateHasMedias->removeElement($candidateHasMedia);
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated use addGalleryHasMedia method instead
     * NEXT_MAJOR: remove this method with the next major release
     */
    public function addCandidateHasMedias(CandidateHasMedia $candidateHasMedia)
    {
        @trigger_error(
            'The '.__METHOD__.' is deprecated and will be removed with next major release.'
            .'Use `addGalleryHasMedia` method instead.',
            E_USER_DEPRECATED
        );
        $this->addCandidateHasMedia($candidateHasMedia);
    }


    /**
     * Reorders $galleryHasMedia items based on their position.
     */
    public function reorderGalleryHasMedia()
    {
        $candidateHasMedias = $this->getCandidateHasMedias();

        if ($candidateHasMedias instanceof \IteratorAggregate) {
            // reorder
            $iterator = $candidateHasMedias->getIterator();

            $iterator->uasort(static function (CandidateHasMedia $a, CandidateHasMedia $b): int {
                return $a->getPosition() <=> $b->getPosition();
            });

            $this->setCandidateHasMedias($iterator);
        }
    }

    /**
     * @return Collection|VoteJury[]
     */
    public function getVoteJuries(): Collection
    {
        return $this->voteJuries;
    }

    public function addVoteJury(VoteJury $voteJury): self
    {
        if (!$this->voteJuries->contains($voteJury)) {
            $this->voteJuries[] = $voteJury;
            $voteJury->setCandidate($this);
        }

        return $this;
    }

    public function removeVoteJury(VoteJury $voteJury): self
    {
        if ($this->voteJuries->removeElement($voteJury)) {
            // set the owning side to null (unless already changed)
            if ($voteJury->getCandidate() === $this) {
                $voteJury->setCandidate(null);
            }
        }

        return $this;
    }

   

  
}
