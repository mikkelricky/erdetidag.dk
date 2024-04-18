<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Form\MessagesType;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::BATCH_DELETE)
            ->add(
                Crud::PAGE_INDEX,
                Action::new('show')->linkToCrudAction('show')
            );
    }

    public function show(AdminContext $context): Response
    {
        /** @var Site $site */
        $site = $context->getEntity()->getInstance();

        return $this->redirectToRoute('site_index', [
            'host' => $site->getHost(),
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('host');
        yield TextField::new('title');
        yield Field::new('messages')->setFormType(MessagesType::class);
    }
}
