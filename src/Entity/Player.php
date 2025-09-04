<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Player
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
    private int $id; // Propriété

    #[ORM\Column(type: "string", length: 100)]
    private string $name;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}