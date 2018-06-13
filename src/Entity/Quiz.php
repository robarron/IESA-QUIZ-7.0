<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 * @ApiResource(iri="http://schema.org/Quiz")
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponse;

    /**
     * @ORM\Column(name="prop_1", type="string", length=255, nullable=true)
     */
    private $prop1;

    /**
     * @ORM\Column(name="prop_2", type="string", length=255, nullable=true)
     */
    private $prop2;

    /**
     * @ORM\Column(name="prop_3", type="string", length=255, nullable=true)
     */
    private $prop3;

    /**
     * @ORM\Column(name="prop_4", type="string", length=255, nullable=true)
     */
    private $prop4;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="quizzes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function getId()
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getProp1(): ?string
    {
        return $this->prop1;
    }

    public function setProp1(?string $prop1): self
    {
        $this->prop1 = $prop1;

        return $this;
    }

    public function getProp2(): ?string
    {
        return $this->prop2;
    }

    public function setProp2(?string $prop2): self
    {
        $this->prop2 = $prop2;

        return $this;
    }

    public function getProp3(): ?string
    {
        return $this->prop3;
    }

    public function setProp3(?string $prop3): self
    {
        $this->prop3 = $prop3;

        return $this;
    }

    public function getProp4(): ?string
    {
        return $this->prop4;
    }

    public function setProp4(?string $prop4): self
    {
        $this->prop4 = $prop4;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
