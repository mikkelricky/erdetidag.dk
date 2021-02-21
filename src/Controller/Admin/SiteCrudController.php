<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Form\MessagesType;
use App\Repository\SiteRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;

class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(
            Crud::PAGE_INDEX,
            Action::new("show")->linkToCrudAction("show")
        );
    }

    public function show(AdminContext $context): Response
    {
        /** @var Site $settings */
        $settings = $context->getEntity()->getInstance();

        return $this->redirectToRoute("settings_index", [
            "host" => $settings->getHost(),
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new("host"),
            Field::new("messages")->setFormType(MessagesType::class),
        ];
    }
}
