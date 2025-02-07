<?php

// src/Entity/Phone.php
namespace App\Entity;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Phone
{
    #[Groups(['customer', 'admin'])]  // Both 'customer' and 'admin' groups
    private string $brand;

    #[Groups(['customer', 'admin'])]  // Both 'customer' and 'admin' groups
    private string $model;

    #[Groups(['admin'])]  // Only the 'admin' group will see the price
    private float $price;

    #[Groups(['admin'])]  // Only the 'admin' group will see the releaseDate
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]  // Custom date format for 'releaseDate'
    private \DateTimeImmutable $releaseDate;

    #[Ignore] // This field will never be serialized or deserialized
    private bool $isDiscontinued;

    public function __construct(string $brand, string $model, float $price, \DateTimeImmutable $releaseDate, bool $isDiscontinued)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->releaseDate = $releaseDate;
        $this->isDiscontinued = $isDiscontinued;
    }

    // Getters for the fields
    public function getBrand(): string { return $this->brand; }
    public function getModel(): string { return $this->model; }
    public function getPrice(): float { return $this->price; }
    public function getReleaseDate(): \DateTimeImmutable { return $this->releaseDate; }
    public function getIsDiscontinued(): bool { return $this->isDiscontinued; }
}
