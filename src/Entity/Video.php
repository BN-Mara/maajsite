<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $releaseYear;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $runningTime;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="video")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=VideoFile::class, mappedBy="video")
     */
    private $videoFiles;

    /**
     * @ORM\OneToMany(targetEntity=SonataMediaMedia::class, mappedBy="video")
     */
    private $sonataMediaMedia;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videoFiles = new ArrayCollection();
        $this->sonataMediaMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReleaseYear(): ?string
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(?string $releaseYear): self
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getRunningTime(): ?\DateTimeInterface
    {
        return $this->runningTime;
    }

    public function setRunningTime(?\DateTimeInterface $runningTime): self
    {
        $this->runningTime = $runningTime;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVideo($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVideo() === $this) {
                $image->setVideo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VideoFile[]
     */
    public function getVideoFiles(): Collection
    {
        return $this->videoFiles;
    }

    public function addVideoFile(VideoFile $videoFile): self
    {
        if (!$this->videoFiles->contains($videoFile)) {
            $this->videoFiles[] = $videoFile;
            $videoFile->setVideo($this);
        }

        return $this;
    }

    public function removeVideoFile(VideoFile $videoFile): self
    {
        if ($this->videoFiles->removeElement($videoFile)) {
            // set the owning side to null (unless already changed)
            if ($videoFile->getVideo() === $this) {
                $videoFile->setVideo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SonataMediaMedia[]
     */
    public function getSonataMediaMedia(): Collection
    {
        return $this->sonataMediaMedia;
    }

    public function addSonataMediaMedium(SonataMediaMedia $sonataMediaMedium): self
    {
        if (!$this->sonataMediaMedia->contains($sonataMediaMedium)) {
            $this->sonataMediaMedia[] = $sonataMediaMedium;
            $sonataMediaMedium->setVideo($this);
        }

        return $this;
    }

    public function removeSonataMediaMedium(SonataMediaMedia $sonataMediaMedium): self
    {
        if ($this->sonataMediaMedia->removeElement($sonataMediaMedium)) {
            // set the owning side to null (unless already changed)
            if ($sonataMediaMedium->getVideo() === $this) {
                $sonataMediaMedium->setVideo(null);
            }
        }

        return $this;
    }
}
