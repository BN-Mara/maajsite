<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sonata\MediaBundle\Entity\BaseGalleryHasMedia;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="candidate_media")
 * @ORM\HasLifecycleCallbacks
 */
class CandidateHasMedia
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
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\SonataMediaMedia",
     *     inversedBy="candidateHasMedias", cascade={"persist"}
     * )
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var SonataMediaMedia
     */
    protected $media;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Candidate::class,
     *     inversedBy="candidateHasMedias", cascade={"persist"}
     * )
     * @ORM\JoinColumn(name="candidate_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var Candidate
     */
    protected $candidate;
   
    /**
     * @var integer
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position = 0;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

   /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

   /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean", nullable=true)
     */
    protected $enabled = false;

    public function __construct()
    {
        $this->position = 0;
        $this->enabled  = false;
        
        $this->updatedAt = new \DateTime('now');
        $this->createdAt = new \DateTime('now');
    }

    public function __toString()
    {
        return $this->getCandidate().' | '.$this->getMedia();
    }

    public function setCreatedAt(?\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }


    public function setMedia(?MediaInterface $media = null)
    {
        $this->media = $media;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setUpdatedAt(?\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    /*public function prePersist(): void
    {
        parent::prePersist();
    }*/

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(): void
    {
        $this->updatedAt= new \DateTime('now');
    }
    public function setCandidate(Candidate $cadidate){
        $this->candidate = $cadidate;

    }
    public function getCandidate(){
        return $this->candidate;
    }
}
