<?php

declare(strict_types=1);

namespace App\Models;

class Product
{
    private ?int $id = null;
    private int $categoria_id;
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private int $stock;
    private ?string $oferta = null;
    private ?string $fecha = null;
    private ?string $imagen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(int $categoria_id): self
    {
        $this->categoria_id = $categoria_id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;
        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    public function getOferta(): ?string
    {
        return $this->oferta;
    }

    public function setOferta(?string $oferta): self
    {
        $this->oferta = $oferta;
        return $this;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(?string $fecha): self
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;
        return $this;
    }
}
