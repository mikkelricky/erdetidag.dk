<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    #[Route('/', name: 'site_index', methods: [Request::METHOD_GET])]
    public function index(
        Request $request,
        SiteRepository $siteRepository
    ): Response {
        $host = $request->get('host', $request->getHost());
        $site = $siteRepository->findOneByHost($host);
        if (null === $site) {
            throw new NotFoundHttpException();
        }
        $now = $this->getNow($request);
        $message = '…';
        if (null !== $site && $site->getMessages()) {
            $day = (int) $now->format('N');
            $message = $site->getMessages()->getDay($day);
        }
        $nextDay = new \DateTimeImmutable(
            $now->format(\DateTimeImmutable::ATOM).' Tomorrow'
        );
        $secondsUntilNextDay = $nextDay->getTimestamp() - $now->getTimestamp();

        return $this->render('site/index.html.twig', [
            'seconds_until_next_day' => $secondsUntilNextDay,
            'message' => $message,
            'site' => $site,
        ]);
    }

    private function getNow(Request $request): \DateTimeImmutable
    {
        try {
            return new \DateTimeImmutable($request->get('now', 'now'));
        } catch (\Exception) {
        }

        return new \DateTimeImmutable('now');
    }
}
