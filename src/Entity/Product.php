<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $ProductCode;

    /**
     * @ORM\Column(type="text")
     */
    private $ProductName;

    /**
     * @ORM\Column(type="text")
     */
    private $ProductDescription;

    /**
     * @ORM\Column(type="integer")
     */
    private $Stock;

    /**
     * @ORM\Column(type="float")
     */
    private $CostinGBP;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Discontinued;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductCode(): ?string
    {
        return $this->ProductCode;
    }

    public function setProductCode(string $ProductCode): self
    {
        $this->ProductCode = $ProductCode;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->ProductName;
    }

    public function setProductName(string $ProductName): self
    {
        $this->ProductName = $ProductName;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->ProductDescription;
    }

    public function setProductDescription(string $ProductDescription): self
    {
        $this->ProductDescription = $ProductDescription;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): self
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getCostinGBP(): ?float
    {
        return $this->CostinGBP;
    }

    public function setCostinGBP(float $CostinGBP): self
    {
        $this->CostinGBP = $CostinGBP;

        return $this;
    }

    public function getDiscontinued(): ?string
    {
        return $this->Discontinued;
    }

    public function setDiscontinued(?string $Discontinued): self
    {
        $this->Discontinued = $Discontinued;

        return $this;
    }
}
