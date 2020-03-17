<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Prestation;
use App\Entity\Projet;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            "name" => ""
        ]);
    }

    /**
     * @Route("/a-propos", name="about")
     */
    public function about()
    {
        return $this->render('main/about.html.twig',[
            "name" => "À Propos"
        ]);
    }

    /**
     * @Route("/prestations", name="prestations")
     */
    public function prestations()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $prestations = $this->getDoctrine()->getRepository(Prestation::class)->findAll();
        dump($categories);
        return $this->render('main/prestations.html.twig',[
            "categories" => $categories,
            "name" => "Prestations",
            "prestations" => $prestations
        ]);
    }

    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function portfolio()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $projets = $this->getDoctrine()->getRepository(Projet::class)->findAll();
        return $this->render('main/portfolio.html.twig',[
            "name" => "Portfolio",
            "categories" => $categories,
            "projets" => $projets
        ]);
    }


    /**
     * @Route("/mentions-legales", name="terms_of_use")
     */
    public function mentions()
    {
        return $this->render('main/terms.html.twig',[
            "name" => "Mentions Légales"
        ]);
    }
    
}
