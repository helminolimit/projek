<?php

namespace App\Entity;

use App\Repository\DataMeterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataMeterRepository::class)]
class DataMeter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $projek;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $progress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjek(): ?string
    {
        return $this->projek;
    }

    public function setProjek(?string $projek): self
    {
        $this->projek = $projek;

        return $this;
    }

    public function getProgress(): ?string
    {
        return $this->progress;
    }

    public function setProgress(?string $progress): self
    {
        $this->progress = $progress;

        return $this;
    }
}
