<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ResultRepository")
 */
class Result
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $victory;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPoint;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    public function getId()
    {
        return $this->id;
    }

    public function getVictory(): ?bool
    {
        return $this->victory;
    }

    public function setVictory(bool $victory): self
    {
        $this->victory = $victory;

        return $this;
    }

    public function getNbPoint(): ?int
    {
        return $this->nbPoint;
    }

    public function setNbPoint(int $nbPoint): self
    {
        $this->nbPoint = $nbPoint;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
