<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
    private $Tile;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Body;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCreated;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Author;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please, upload the article image file.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $Url;

    /**
    * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="articles")
    */
    protected $categorie;

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShortDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTile(): ?string
    {
        return $this->Tile;
    }

    public function setTile(string $Tile): self
    {
        $this->Tile = $Tile;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->Body;
    }

    public function setBody(?string $Body): self
    {
        $this->Body = $Body;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->DateCreated;
    }

    public function setDateCreated(\DateTimeInterface $DateCreated): self
    {
        $this->DateCreated = $DateCreated;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->Author;
    }

    public function setAuthor(string $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->ShortDescription;
    }

    public function setShortDescription(?string $ShortDescription): self
    {
        $this->ShortDescription = $ShortDescription;

        return $this;
    }

    public function getUrl()
    {
        return $this->Url;
    }

    public function setUrl($Url)
    {
        $this->Url = $Url;

        return $this;
    }
}
