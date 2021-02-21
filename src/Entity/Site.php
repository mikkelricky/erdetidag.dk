<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use App\Validator\Host;
use App\Validator\ValidHost;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 * @UniqueEntity(fields={"host"})
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     * @ValidHost()
     */
    private $host;

    /**
     * @ORM\Embedded(class="Messages")
     * @Assert\Valid()
     */
    private $messages;

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
}
