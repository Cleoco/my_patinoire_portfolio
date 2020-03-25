<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 * @Vich\Uploadable
 */
class Projet
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="projets")
     */
    private $category;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projet_une", fileNameProperty="imageUneName")
     * 
     * @var File|null
     */
    private $imageUneFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageUneName;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projet_image1", fileNameProperty="imageName1")
     * 
     * @var File|null
     */
    private $imageFile1;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageName1;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projet_image2", fileNameProperty="imageName2")
     * 
     * @var File|null
     */
    private $imageFile2;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageName2;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projet_image3", fileNameProperty="imageName3")
     * 
     * @var File|null
     */
    private $imageFile3;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageName3;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projet_image4", fileNameProperty="imageName4")
     * 
     * @var File|null
     */
    private $imageFile4;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageName4;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projet_image5", fileNameProperty="imageName5")
     * 
     * @var File|null
     */
    private $imageFile5;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageName5;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $alt;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $alt2;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $alt3;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $alt4;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $alt5;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $alt6;


    public function __construct()
    {
        $this->category = new ArrayCollection();
        $now = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $this->setCreatedAt($now);
        $this->setUpdatedAt($now);
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageUneFile
     */
    public function setImageUneFile(?File $imageUneFile = null): void
    {
        $this->imageUneFile = $imageUneFile;

        if (null !== $imageUneFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageUneFile(): ?File
    {
        return $this->imageUneFile;
    }

    public function setImageUneName(?string $imageUneName): void
    {
        $this->imageUneName = $imageUneName;
    }

    public function getImageUneName(): ?string
    {
        return $this->imageUneName;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile1
     */
    public function setImageFile1(?File $imageFile1 = null): void
    {
        $this->imageFile1 = $imageFile1;

        if (null !== $imageFile1) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile1(): ?File
    {
        return $this->imageFile1;
    }

    public function setImageName1(?string $imageName1): void
    {
        $this->imageName1 = $imageName1;
    }

    public function getImageName1(): ?string
    {
        return $this->imageName1;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile2
     */
    public function setImageFile2(?File $imageFile2 = null): void
    {
        $this->imageFile2 = $imageFile2;

        if (null !== $imageFile2) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile2(): ?File
    {
        return $this->imageFile2;
    }

    public function setImageName2(?string $imageName2): void
    {
        $this->imageName2 = $imageName2;
    }

    public function getImageName2(): ?string
    {
        return $this->imageName2;
    }

/**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile3
     */
    public function setImageFile3(?File $imageFile3 = null): void
    {
        $this->imageFile3 = $imageFile3;

        if (null !== $imageFile3) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile3(): ?File
    {
        return $this->imageFile3;
    }

    public function setImageName3(?string $imageName3): void
    {
        $this->imageName3 = $imageName3;
    }

    public function getImageName3(): ?string
    {
        return $this->imageName3;
    }


/**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile4
     */
    public function setImageFile4(?File $imageFile4 = null): void
    {
        $this->imageFile4 = $imageFile4;

        if (null !== $imageFile4) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile4(): ?File
    {
        return $this->imageFile4;
    }

    public function setImageName4(?string $imageName4): void
    {
        $this->imageName4 = $imageName4;
    }

    public function getImageName4(): ?string
    {
        return $this->imageName4;
    }


/**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile5
     */
    public function setImageFile5(?File $imageFile5 = null): void
    {
        $this->imageFile5 = $imageFile5;

        if (null !== $imageFile5) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile5(): ?File
    {
        return $this->imageFile5;
    }

    public function setImageName5(?string $imageName5): void
    {
        $this->imageName5 = $imageName5;
    }

    public function getImageName5(): ?string
    {
        return $this->imageName5;
    }


    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getAlt2(): ?string
    {
        return $this->alt2;
    }

    public function setAlt2(?string $alt2): self
    {
        $this->alt2 = $alt2;

        return $this;
    }

    public function getAlt3(): ?string
    {
        return $this->alt3;
    }

    public function setAlt3(?string $alt3): self
    {
        $this->alt3 = $alt3;

        return $this;
    }

    public function getAlt4(): ?string
    {
        return $this->alt4;
    }

    public function setAlt4(?string $alt4): self
    {
        $this->alt4 = $alt4;

        return $this;
    }

    public function getAlt5(): ?string
    {
        return $this->alt5;
    }

    public function setAlt5(?string $alt5): self
    {
        $this->alt5 = $alt5;

        return $this;
    }

    public function getAlt6(): ?string
    {
        return $this->alt6;
    }

    public function setAlt6(?string $alt6): self
    {
        $this->alt6 = $alt6;

        return $this;
    }
}
