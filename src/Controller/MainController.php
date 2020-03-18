<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\FiltersBlog;
use App\Entity\Prestation;
use App\Entity\Projet;
use App\Repository\CategoryRepository;
use App\Repository\FiltersBlogRepository;
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
     * @Route("/portfolio/{id}", name="projets_category")
     */
    public function projectByCategory($id, CategoryRepository $repo){
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $category = $repo->find($id);
        $categoryTitle = $category-> getName();
        $projets = $category->getProjets();
        return $this->render('main/portfolio.html.twig', [
            'projets'=> $projets,
            "name" => $categoryTitle,
            "categories" => $categories,
            
        ]);
    }

       
    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        $filters = $this->getDoctrine()->getRepository(FiltersBlog::class)->findAll();
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('main/blog.html.twig',[
            "name" => "Blog",
            "filters" => $filters,
            "articles" => $articles,
            "filterName" => "TOUT"
        ]);
    }
    /**
     * @Route("/blog/{id}", name="blog_filters")
     */
    public function articlesByFilters($id, FiltersBlogRepository $repo){
        $filters = $this->getDoctrine()->getRepository(FiltersBlog::class)->findAll();
        $filter = $repo->find($id);
        $filterName = $filter-> getName();
        dump($filterName);
        $articles = $filter->getArticles();
        return $this->render('main/blog.html.twig', [
            'articles'=> $articles,
            "name" => "Blog",
            "filters" => $filters,
            "filterName" => $filterName
            
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
