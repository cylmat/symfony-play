<?php

namespace App\AppBundle\Domain\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\AppBundle\Infrastructure\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/** @SuppressWarnings(PHPMD.ShortVariable) */
#[ApiResource()]
#[ORM\Table(name: 'log')]
#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(type: 'string')]
    protected string $level;

    #[ORM\Column(type: 'string')]
    protected string $channel;

    #[ORM\Column(type: 'string')]
    protected string $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
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
