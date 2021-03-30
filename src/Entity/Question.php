<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")

     */



    private $id;

    /**
     * @ORM\Column(type="text")
     */

    /**
     * @ORM\Column(type="text", length=255)
     * @Assert\Length(
     *      min = 10,
     *      max = 200,
     *      minMessage = "L'enonce doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "L'enonce doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $enonce;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "La reponse doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "la reponse doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $choix1;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "La reponse doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "la reponse doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $choix2;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 0,
     *      max = 255,
     *      minMessage = "La reponse doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "la reponse doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $choix3;



    /**
     * @ORM\ManyToOne(targetEntity=Quiz::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quiz;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponse;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEnonce(): ?string
    {
        return $this->enonce;
    }

    /**
     * @return mixed
     */
    public function getChoix1()
    {
        return $this->choix1;
    }

    /**
     * @param mixed $choix1
     */
    public function setChoix1($choix1): void
    {
        $this->choix1 = $choix1;
    }

    /**
     * @return mixed
     */
    public function getChoix2()
    {
        return $this->choix2;
    }

    /**
     * @param mixed $choix2
     */
    public function setChoix2($choix2): void
    {
        $this->choix2 = $choix2;
    }

    /**
     * @return mixed
     */
    public function getChoix3()
    {
        return $this->choix3;
    }

    /**
     * @param mixed $choix3
     */
    public function setChoix3($choix3): void
    {
        $this->choix3 = $choix3;
    }






    public function setEnonce(string $enonce): self
    {
        $this->enonce = $enonce;

        return $this;
    }



    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

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



}
