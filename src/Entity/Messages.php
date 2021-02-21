<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use RuntimeException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable()
 */
class Messages
{
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $monday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $tuesday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $wednesday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $thursday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $friday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $saturday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $sunday;

    public function __toString()
    {
        return implode(", ", array_map([$this, "getDay"], range(1, 7)));
    }

    public function getMonday(): ?string
    {
        return $this->monday;
    }

    public function setMonday(string $monday): self
    {
        $this->monday = $monday;

        return $this;
    }

    public function getTuesday(): ?string
    {
        return $this->tuesday;
    }

    public function setTuesday(string $tuesday): self
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getWednesday(): ?string
    {
        return $this->wednesday;
    }

    public function setWednesday(string $wednesday): self
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getThursday(): ?string
    {
        return $this->thursday;
    }

    public function setThursday(string $thursday): self
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getFriday(): ?string
    {
        return $this->friday;
    }

    public function setFriday(string $friday): self
    {
        $this->friday = $friday;

        return $this;
    }

    public function getSaturday(): ?string
    {
        return $this->saturday;
    }

    public function setSaturday(string $saturday): self
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSunday(): ?string
    {
        return $this->sunday;
    }

    public function setSunday(string $sunday): self
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getDay(int $day)
    {
        switch ($day) {
            case 1:
                return $this->getMonday();
            case 2:
                return $this->getTuesday();
            case 3:
                return $this->getWednesday();
            case 4:
                return $this->getThursday();
            case 5:
                return $this->getFriday();
            case 6:
                return $this->getSaturday();
            case 7:
                return $this->getSunday();
        }

        throw new RuntimeException(sprintf("Invalid day: %d", $day));
    }
}
