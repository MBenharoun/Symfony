<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Plateform;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlateform(): ?bool
    {
        return $this->Plateform;
    }

    public function setPlateform(bool $Plateform): self
    {
        $this->Plateform = $Plateform;

        return $this;
    }
}
