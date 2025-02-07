<?php

// src/Model/Student.php
namespace App\Model;

class Student
{
    public function __construct(
        private string $name,
        private int $age,
        private bool $passed
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function isPassed(): bool
    {
        return $this->passed;
    }
}
