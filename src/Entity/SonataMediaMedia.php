<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sonata\MediaBundle\Entity\BaseMedia;

/**
 * @ORM\Entity
 * @ORM\Table(name="media__media")
 * @ORM\HasLifecycleCallbacks
 */
class SonataMediaMedia extends BaseMedia
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups(groups={"sonata_api_read", "sonata_api_write", "sonata_search"})
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\SonataMediaGalleryHasMedia",
     *     mappedBy="media", cascade={"persist"}, orphanRemoval=false
     * )
     *
     * @var SonataMediaGalleryHasMedia[]
     */
    protected $galleryHasMedias;

      /**
     * @ORM\OneToMany(
     *     targetEntity=CandidateHasMedia::class,
     *     mappedBy="media", cascade={"persist"}, orphanRemoval=false
     * )
     *
     * @var CandidateHasMedia[]
     */
    protected $candidateHasMedias;

    /**
     * Fix annotations if you use classification-bundle.
     *
     * // ORM\ManyToOne(
     *     targetEntity="App\Entity\SonataClassificationCategory",
     *     cascade={"persist"}
     * )
     * // ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="SET NULL")
     *
     * @var SonataClassificationCategory
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity=Video::class, inversedBy="sonataMediaMedia")
     */
    private $video;

    /**
     * @ORM\OneToOne(targetEntity=Candidate::class, mappedBy="coverImage", cascade={"persist", "remove"})
     */
    private $candidate;

    public function __construct()
    {
        $this->candidateHasMedia2s = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        parent::prePersist();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(): void
    {
        parent::preUpdate();
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): self
    {
        // unset the owning side of the relation if necessary
        if ($candidate === null && $this->candidate !== null) {
            $this->candidate->setCoverImage(null);
        }

        // set the owning side of the relation if necessary
        if ($candidate !== null && $candidate->getCoverImage() !== $this) {
            $candidate->setCoverImage($this);
        }

        $this->candidate = $candidate;

        return $this;
    }

 


}
