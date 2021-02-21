<?php

namespace App\Controller\Admin;

use App\Entity\Day;
use App\Entity\Settings;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $urlGenerator = $this->get(AdminUrlGenerator::class);

        return $this->redirect(
            $urlGenerator
                ->setController(SettingsCrudController::class)
                ->generateUrl()
        );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle($this->getParameter("site_title"));
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud(
            "Settings",
            "fas fa-calendar",
            Settings::class
        );
        yield MenuItem::linkToUrl(
            "Show",
            "fas fa-home",
            $this->generateUrl("settings_index")
        );
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)->setMenuItems([
            // Remove the logout menu item.
        ]);
    }
}
