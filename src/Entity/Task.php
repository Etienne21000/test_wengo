<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Task
{
    const STATE = [
        0 => 'A faire',
        1 => 'En cours',
        2 => 'Terminée'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modification_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modification_date;
    }

    public function setModificationDate(?\DateTimeInterface $modification_date): self
    {
        $this->modification_date = $modification_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function getStateType(): string
    {
        return self::STATE[$this->state];
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function UpdatedDate()
    {
        if($this->getCreationDate() == null)
        {
            $this->setCreationDate(new \DateTime('now'));
        }
        else
        {
            $this->setModificationDate(new \DateTime('now'));
        }
    }

    // /**
    // * @ORM\PrePersist
    // * @ORM\PreUpdate
    // */
    // public function updateState()
    // {
    //     if($this->getModificationDate() == null)
    //     {
    //         $this->state = 0;
    //     }
    // }

    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function validateTask()
    {
        if ($this->getState() == 2)
        {
            $this->setEndDate(new \DateTime('now'));
        }
    }
}
