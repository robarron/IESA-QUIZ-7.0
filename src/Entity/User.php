<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(iri="http://schema.org/User")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Game", mappedBy="player1")
     */
    private $gamesPlayer1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Game", mappedBy="player2")
     */
    private $gamesPlayer2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Result", mappedBy="User")
     */
    private $results;

    public function __construct()
    {
        parent::__construct();
        $this->gamesPlayer1 = new ArrayCollection();
        $this->gamesPlayer2 = new ArrayCollection();
        $this->results = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGamesPlayer1(): Collection
    {
        return $this->gamesPlayer1;
    }

    public function addGamePlayer1(Game $gamePlayer1): self
    {
        if (!$this->gamesPlayer1->contains($gamePlayer1)) {
            $this->gamesPlayer1[] = $gamePlayer1;
            $gamePlayer1->setPlayer1($this);
        }

        return $this;
    }

    public function removePlayer1(Game $gamePlayer1): self
    {
        if ($this->gamesPlayer1->contains($gamePlayer1)) {
            $this->gamesPlayer1->removeElement($gamePlayer1);
            // set the owning side to null (unless already changed)
            if ($gamePlayer1->getPlayer1() === $this) {
                $gamePlayer1->setPlayer1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGamesPlayer2(): Collection
    {
        return $this->gamesPlayer2;
    }

    public function addGamePlayer2(Game $gamePlayer2): self
    {
        if (!$this->gamesPlayer2->contains($gamePlayer2)) {
            $this->gamesPlayer2[] = $gamePlayer2;
            $gamePlayer2->setPlayer2($this);
        }

        return $this;
    }

    public function removeGame(Game $gamePlayer2): self
    {
        if ($this->gamesPlayer2->contains($gamePlayer2)) {
            $this->gamesPlayer2->removeElement($gamePlayer2);
            // set the owning side to null (unless already changed)
            if ($gamePlayer2->getPlayer2() === $this) {
                $gamePlayer2->setPlayer2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Result[]
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(Result $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
            $result->setUser($this);
        }

        return $this;
    }

    public function removeResult(Result $result): self
    {
        if ($this->results->contains($result)) {
            $this->results->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getUser() === $this) {
                $result->setUser(null);
            }
        }

        return $this;
    }
}
