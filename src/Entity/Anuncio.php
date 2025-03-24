<?php

namespace App\Entity;

use App\Repository\AnuncioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnuncioRepository::class)]
class Anuncio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomeAnuncio = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descricion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataPublicacion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataVenta = null;

    #[ORM\Column]
    private ?bool $vendido = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $prezoInicial = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $prezoFinal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeAnuncio(): ?string
    {
        return $this->nomeAnuncio;
    }

    public function setNomeAnuncio(string $nomeAnuncio): static
    {
        $this->nomeAnuncio = $nomeAnuncio;

        return $this;
    }

    public function getDescricion(): ?string
    {
        return $this->descricion;
    }

    public function setDescricion(string $descricion): static
    {
        $this->descricion = $descricion;

        return $this;
    }

    public function getDataPublicacion(): ?\DateTimeInterface
    {
        return $this->dataPublicacion;
    }

    public function setDataPublicacion(\DateTimeInterface $dataPublicacion): static
    {
        $this->dataPublicacion = $dataPublicacion;

        return $this;
    }

    public function getDataVenta(): ?\DateTimeInterface
    {
        return $this->dataVenta;
    }

    public function setDataVenta(?\DateTimeInterface $dataVenta): static
    {
        $this->dataVenta = $dataVenta;

        return $this;
    }

    public function isVendido(): ?bool
    {
        return $this->vendido;
    }

    public function setVendido(bool $vendido): static
    {
        $this->vendido = $vendido;

        return $this;
    }

    public function getPrezoInicial(): ?string
    {
        return $this->prezoInicial;
    }

    public function setPrezoInicial(string $prezoInicial): static
    {
        $this->prezoInicial = $prezoInicial;

        return $this;
    }

    public function getPrezoFinal(): ?string
    {
        return $this->prezoFinal;
    }

    public function setPrezoFinal(?string $prezoFinal): static
    {
        $this->prezoFinal = $prezoFinal;

        return $this;
    }
}
