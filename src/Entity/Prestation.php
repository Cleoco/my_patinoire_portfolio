<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestationRepository")
 */
class Prestation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *    message = "Ce champ doit être rempli",
     * )
     * @Assert\NotBlank(
     *    message = "Ce champ doit être rempli",
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre titre doit contenir au moins {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *  @Assert\NotBlank(
     *    message = "Ce champ doit être rempli",
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre description doit contenir au moins {{ limit }} caractères")
     */
    private $contentLeft;

    /**
     * @ORM\Column(type="text")
     * 
     *  @Assert\NotBlank(
     *    message = "Ce champ doit être rempli",
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre description doit contenir au moins {{ limit }} caractères")
     */
    private $contentRight;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category", inversedBy="prestation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

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

    public function getContentLeft(): ?string
    {
        return $this->contentLeft;
    }

    public function setContentLeft(string $contentLeft): self
    {
        $this->contentLeft = $contentLeft;

        return $this;
    }

    public function getContentRight(): ?string
    {
        return $this->contentRight;
    }

    public function setContentRight(string $contentRight): self
    {
        $this->contentRight = $contentRight;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
