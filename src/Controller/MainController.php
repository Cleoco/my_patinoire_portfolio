<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\FiltersBlog;
use App\Entity\Prestation;
use App\Entity\Projet;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\FiltersBlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $projets = $this->getDoctrine()->getRepository(Projet::class)->findBy([],['createdAt' => 'ASC'],6);
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            "categories" => $categories,
            "projets" => $projets
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
            "projets" => $projets,
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
     * @Route("/blog", name="blog" ,  methods={"GET","POST"})
     */
    public function blog(PaginatorInterface $paginator, Request $request): Response
    {
        dump($request);
        $filters = $this->getDoctrine()->getRepository(FiltersBlog::class)->findAll();
        $articles = $paginator->paginate($this->getDoctrine()->getRepository(Article::class)
            ->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            4
    );

        return $this->render('main/blog.html.twig',[
            "name" => "Blog",
            "filters" => $filters,
            "articles" => $articles,
            "filterName" => "TOUT"
        ]);
    }

    /**
     * @Route("/blog/search", name="blog_search")
     */
    public function search(Request $request): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        $keyWord = $request->request->get('search');
        $keyWordSearched = htmlspecialchars($keyWord);
        $articlesByKeyword = [];

        if(empty($keyWord) == false){
            for($i=0; $i<count($articles); $i++){
                if(stristr($articles[$i]->getContent(), $keyWordSearched,) || stristr($articles[$i]->getTitle(), $keyWordSearched,) ){
                    $articlesByKeyword[]=$articles[$i];
                }
            }
        }
        dump($articlesByKeyword);
        $filters = $this->getDoctrine()->getRepository(FiltersBlog::class)->findAll();
    //     $articles = $paginator->paginate($this->getDoctrine()->getRepository(Article::class)
    //         ->findAll(),
    //         $request->query->getInt('page', 1), /*page number*/
    //         4
    // );
        return $this->render('main/blogSearch.html.twig',[
            "articles" => $articles,
            "name" => "Votre recherche",
            "filters" => $filters,
            "articlesByKeyword" => $articlesByKeyword,
            // "filterName" => "TOUT"
        ]);
    }


    /**
     * @Route("/blog/categorie/{id}", name="blog_filters")
     */
    public function articlesByFilters($id, FiltersBlogRepository $repo, PaginatorInterface $paginator, Request $request, FiltersBlog $filtersBlog ){
        $filters = $this->getDoctrine()->getRepository(FiltersBlog::class)->findAll();
        $filter = $repo->find($id);
        $filterName = $filter-> getName();
        $articles = $paginator->paginate($this->getDoctrine()->getRepository(Article::class)
        ->findBy(array('filter' => $filtersBlog),array('id' => 'desc') ),
        $request->query->getInt('page', 1), /*page number*/
        6
    );

        return $this->render('main/blog.html.twig', [
            'articles'=> $articles,
            "name" => "Blog",
            "filters" => $filters,
            "filterName" => $filterName,
            
            
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
