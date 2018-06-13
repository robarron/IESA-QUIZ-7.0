<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContext;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="player1")
     * @Assert\Expression(
     *     "this.player1 = this.player2",
     *     message="the players must be different !"
     * )
     */
    private $player1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="games")
     * @Assert\Expression(
     *     "this.player2 = this.player1",
     *     message="the players must be different !"
     * )
     */
    private $player2;

    public function getId()
    {
        return $this->id;
    }

    public function getPlayer1(): ?User
    {
        return $this->player1;
    }

    public function setPlayer1(?User $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): ?User
    {
        return $this->player2;
    }

    public function setPlayer2(?User $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function isPlayer1IsEqual2(ExecutionContext $context)
    {
        $p1 = $this->player1;
        $p2 = $this->player2;

        if($p1 == $p2){
            $context->addViolationAtSubPath('player1', 'The players must be different !', array(), null);
        }
    }
}
