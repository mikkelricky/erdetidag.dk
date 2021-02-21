<?php

namespace App\Controller;

use App\Repository\SettingsRepository;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class SettingsController extends AbstractController
{
    /**
     * @Route("/", name="settings_index", methods={"GET"})
     */
    public function index(
        Request $request,
        SettingsRepository $settingsRepository
    ): Response {
        $now = $this->getNow($request);
        $settings = $settingsRepository->findTheOne();
        $message = "…";
        if (null !== $settings) {
            $day = (int) $now->format("N");
            $message = $settings->getDay($day);
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
