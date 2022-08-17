<?php

namespace App\Entity;

use App\Repository\CutiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CutiRepository::class)]
class Cuti
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Nama;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $NomborStaff;

    #[ORM\Column(type: 'datetime', length: 10, nullable: true)]
    private $tarikhMulaCuti;

    #[ORM\Column(type: 'datetime', length: 10, nullable: true)]
    private $tarikhAkhirCuti;

    // #[ORM\Column(type: 'datetime', nullable: true)]
    // private $newdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNama(): ?string
    {
        return $this->Nama;
    }

    public function setNama(?string $Nama): self
    {
        $this->Nama = $Nama;

        return $this;
    }

    public function getNomborStaff(): ?string
    {
        return $this->NomborStaff;
    }

    public function setNomborStaff(?string $NomborStaff): self
    {
        $this->NomborStaff = $NomborStaff;

        return $this;
    }

    public function getTarikhMulaCuti(): ?\DateTimeInterface
    {
        return $this->tarikhMulaCuti;
    }

    public function setTarikhMulaCuti(?\DateTimeInterface $tarikhMulaCuti): self
    {
        $this->tarikhMulaCuti = $tarikhMulaCuti;

        return $this;
    }

    public function getTarikhAkhirCuti(): ?\DateTimeInterface
    {
        return $this->tarikhAkhirCuti;
    }

    public function setTarikhAkhirCuti(?\DateTimeInterface $tarikhAkhirCuti): self
    {
        $this->tarikhAkhirCuti = $tarikhAkhirCuti;

        return $this;
    }

    // public function getNewdate(): ?\DateTimeInterface
    // {
    //     return $this->newdate;
    // }

    // public function setNewdate(?\DateTimeInterface $newdate): self
    // {
    //     $this->newdate = $newdate;

    //     return $this;
    // }
}
