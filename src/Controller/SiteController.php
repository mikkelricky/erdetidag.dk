<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="settings_index", methods={"GET"})
     */
    public function index(
        Request $request,
        SiteRepository $settingsRepository
    ): Response {
        $host = $request->get("host", $request->getHost());
        $settings = $settingsRepository->findOneByHost($host);
        $now = $this->getNow($request);
        $message = "…";
        if (null !== $settings && $settings->getMessages()) {
            $day = (int) $now->format("N");
            $message = $settings->getMessages()->getDay($day);
        }
        $nextDay = new DateTimeImmutable(
            $now->format(DateTimeImmutable::ATOM) . " Tomorrow"
        );
        $secondsUntilNextDay = $nextDay->getTimestamp() - $now->getTimestamp();

        return $this->render("settings/index.html.twig", [
            "seconds_until_next_day" => $secondsUntilNextDay,
            "message" => $message,
        ]);
    }

    private function getNow(Request $request): DateTimeImmutable
    {
        try {
            return new DateTimeImmutable($request->get("now", "now"));
        } catch (Exception $exception) {
        }
        return new DateTimeImmutable("now");
    }
}
