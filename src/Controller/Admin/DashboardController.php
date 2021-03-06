<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Auteur;
use App\Entity\Editeur;
use App\Entity\Produit;
use App\Entity\Fournisseur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    // public function index(): Response
    // {
    //     return parent::index();
    // }

    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        // return $this->render('some/path/my-dashboard.html.twig');
        // return $this->render('dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {
        return [
        // MenuItem::linktoDashboard('Accueil', 'fa fa-home'),
        MenuItem::linkToUrl('Accueil', 'fa fa-home', '/'),
        MenuItem::linkToCrud('Utilisateurs', 'fa fa-tags', User::class),
        MenuItem::section('Mes BD'),
            MenuItem::linkToCrud('Produits', 'fa fa-tags', Produit::class),
            MenuItem::linkToCrud('Auteurs', 'fa fa-tags', Auteur::class),
            MenuItem::linkToCrud('Genres', 'fa fa-tags', Genre::class),
            MenuItem::linkToCrud('Editeurs', 'fa fa-tags', Editeur::class),
            MenuItem::linkToCrud('Fournisseurs', 'fa fa-tags', Fournisseur::class)
        ];
    }

    // public function configureAssets(): Assets
    // {
    //     return Assets::new()->addCssFile('css/admin.css');
    // }
}
