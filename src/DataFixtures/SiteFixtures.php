<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use App\Entity\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SiteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $site = $this->createSite(
            '*',
            'Er det i dag?',
            [
                'Ja.',
                'Ja.',
                'Ja.',
                'Jan.',
                'Ja.',
                'Ja.',
                'Ja.',
            ]
        );
        $manager->persist($site);

        $site = $this->createSite(
            'erdetfredag.dk',
            'Er det fredag i dag?',
            [
                'Nej.',
                'Nej.',
                'Nej.',
                'Næsten.',
                'Ja.',
                'Nej, det var i går.',
                'Nej.',
            ]
        );
        $manager->persist($site);

        $site = $this->createSite(
            'erdetkjolefredag.nu',
            'Er det kjolefredag i dag?',
            [
                'Nej',
                'Nej',
                'Nej',
                'Næsten',
                'Ja',
                'Nej, det var i går',
                'Nej',
            ]
        );
        $manager->persist($site);

        $manager->flush();
    }

    /**
     * @param array<string> $messages
     */
    private function createSite(string $host, string $title, array $messages): Site
    {
        $site = (new Site())
            ->setHost($host)
            ->setTitle($title)
            ->setMessages((new Messages())
                          ->setMonday($messages[0])
                          ->setTuesday($messages[1])
                          ->setWednesday($messages[2])
                          ->setThursday($messages[3])
                          ->setFriday($messages[4])
                          ->setSaturday($messages[5])
                          ->setSunday($messages[6])
            );

        return $site;
    }
}
