<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'First name is required.')]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'Last name is required.')]
    private ?string $lastName = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Age is required.')]
    #[Assert\Range(min: 18, max: 65, notInRangeMessage: 'Age must be between 18 and 65.')]
    private ?int $age = null;

    #[ORM\Column(type: 'string', length: 150, unique: true)]
    #[Assert\NotBlank(message: 'Email is required.')]
    #[Assert\Email(message: 'Invalid email format.')]
    private ?string $email = null;

    // Add getter and setter methods for the properties
    public function getFirstName(): ?string { return $this->firstName; }
    public function setFirstName(string $firstName): self { $this->firstName = $firstName; return $this; }

    public function getLastName(): ?string { return $this->lastName; }
    public function setLastName(string $lastName): self { $this->lastName = $lastName; return $this; }

    public function getAge(): ?int { return $this->age; }
    public function setAge(int $age): self { $this->age = $age; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

   

}
