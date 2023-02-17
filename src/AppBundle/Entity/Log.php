<?php

namespace App\AppBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\AppBundle\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/** @todo #[ApiResource] */
/** @SuppressWarnings(PHPMD.ShortVariable) */
#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $level;

    #[ORM\Column(type: 'string')]
    private string $channel;

    #[ORM\Column(type: 'string')]
    private string $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
