<?php

declare(strict_types=1);

namespace App\Models;

class Order
{
    private ?int $id = null;
    private int $usuario_id;
    private string $provincia;
    private string $localidad;
    private string $direccion;
    private float $coste;
    private string $estado = 'confirm';
    private ?string $fecha = null;
    private ?string $hora = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id): self
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getProvincia(): string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;
        return $this;
    }

    public function getLocalidad(): string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): self
    {
        $this->localidad = $localidad;
        return $this;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;
        return $this;
    }

    public function getCoste(): float
    {
        return $this->coste;
    }

    public function setCoste(float $coste): self
    {
        $this->coste = $coste;
        return $this;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;
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

    public function getHora(): ?string
    {
        return $this->hora;
    }

    public function setHora(?string $hora): self
    {
        $this->hora = $hora;
        return $this;
    }
}
