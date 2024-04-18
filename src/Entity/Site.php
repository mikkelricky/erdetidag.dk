<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use App\Validator as AppAssert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
#[ORM\Table(name: 'erdetidag_site')]
#[UniqueEntity(fields: ['host'])]
class Site
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[AppAssert\ValidHost()]
    private ?string $host = null;

    #[ORM\Embedded(class: Messages::class)]
    #[Assert\Valid]
    private ?Messages $messages;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    private ?string $title = null;

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getMessages(): ?Messages
    {
        return $this->messages;
    }

    public function setMessages(Messages $messages): self
    {
        $this->messages = $messages;

        return $this;
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
}
