<?php

namespace App\Controller\Admin;

use App\Entity\Settings;
use App\Repository\SettingsRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class SettingsCrudController extends AbstractCrudController
{
    /** @var SettingsRepository */
    private $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Settings::class;
    }

    public function index(AdminContext $context)
    {
        $settings = $this->settingsRepository->findTheOne();
        $adminUrlGenerator = $this->get(AdminUrlGenerator::class);
        $adminUrlGenerator->setController(SettingsCrudController::class);
        if (null === $settings) {
            $adminUrlGenerator->setAction(Action::NEW);
        } else {
            $adminUrlGenerator
                ->setAction(Action::EDIT)
                ->setEntityId($settings->getId());
        }

        return $this->redirect($adminUrlGenerator->generateUrl());
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::SAVE_AND_ADD_ANOTHER);
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
