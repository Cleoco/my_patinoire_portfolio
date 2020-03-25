<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{

    private $menu_categories;
    function __construct(CategoryRepository $repo)
    {
        $this->menu_categories = $repo->findAll();
    }

    /**
     * @Route("/admin", name="admin_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            "name" => "votre espace de gestion"
        ]);
    }



    // ---------------------- CATEGORIES --------------------



    /**
     * @Route("/admin/categories", name="category_index", methods={"GET"})
     */
    public function categoryList(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            "name" => "Gérez vos catégories"
        ]);
    }

    /**
     * @Route("/admin/categories/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menu_categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            
            'form' => $form->createView(),
            "name" => "Ajouter une catégorie",
            'menu_categories'=>$menu_categories 
        ]);
    }

    /**
     * @Route("/admin/categories/{id}", name="category_show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        $categoryName = $category-> getName();
        return $this->render('category/show.html.twig', [
            'category' => $category,
            "name" => $categoryName
        ]);
    }

    /**
     * @Route("/admin/categories/{id}/edit", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $menu_categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
            "name" => "Modifier une catégorie",
            'menu_categories'=>$menu_categories 
        ]);
    }

    /**
     * @Route("/admin/categories/{id}", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index');
    }
}


// ---------------------- PRESTATIONS --------------------

class PrestationController extends AbstractController
{
    /**
     * @Route("/admin/prestations", name="prestation_index", methods={"GET"})
     */
    public function index(PrestationRepository $prestationRepository): Response
    {
        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestationRepository->findAll(),
            "name" => "Gérer vos prestations"
        ]);
    }

    /**
     * @Route("/admin/prestations/new", name="prestation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menu_categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        dump($menu_categories);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
            "name" => "Ajouter une prestation",
            'menu_categories'=>$menu_categories 
        ]);
    }

    /**
     * @Route("/admin/prestations/{id}", name="prestation_show", methods={"GET"})
     */
    public function show(Prestation $prestation): Response
    {
        $prestationTitle = $prestation-> getTitle();
        return $this->render('prestation/show.html.twig', [
            'prestation' => $prestation,
            "name" => $prestationTitle
        ]);
    }

    /**
     * @Route("/admin/prestations/{id}/edit", name="prestation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prestation $prestation): Response
    {
        $menu_categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('prestation/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
            "name" => "Modifier une prestation",
            'menu_categories'=>$menu_categories 
        ]);
    }

    /**
     * @Route("/admin/prestations/{id}", name="prestation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Prestation $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prestation_index');
    }
}

    // ---------------------- PROJETS --------------------

    class ProjetController extends AbstractController
    {
        /**
         * @Route("/admin/projets", name="projet_index", methods={"GET"})
         */
        public function index(ProjetRepository $projetRepository): Response
        {
            return $this->render('projet/index.html.twig', [
                'projets' => $projetRepository->findAll(),
                "name" => "Gérer vos projets",
            ]);
        }
    
        /**
         * @Route("/admin/projets/new", name="projet_new", methods={"GET","POST"})
         */
        public function new(Request $request): Response
        {
            $projet = new Projet();
            $form = $this->createForm(ProjetType::class, $projet);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($projet);
                $entityManager->flush();
    
                return $this->redirectToRoute('projet_index');
            }
    
            return $this->render('projet/new.html.twig', [
                'projet' => $projet,
                'form' => $form->createView(),
                "name" => "Ajouter un projet",
            ]);
        }
    
        /**
         * @Route("/projets/{id}", name="projet_show", methods={"GET"})
         */
        public function show(Projet $projet): Response
        {
            $projets = $this->getDoctrine()->getRepository(Projet::class)->findAll();
            $projetTitle = $projet-> getTitle();
            dump($projets);
            return $this->render('projet/show.html.twig', [
                'projet' => $projet,
                "projets" => $projets,
                "name" => $projetTitle
            ]);
        }
    
        /**
         * @Route("/admin/projets/{id}/edit", name="projet_edit", methods={"GET","POST"})
         */
        public function edit(Request $request, Projet $projet): Response
        {
            $form = $this->createForm(ProjetType::class, $projet);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('projet_index');
            }
    
            return $this->render('projet/edit.html.twig', [
                'projet' => $projet,
                'form' => $form->createView(),
                "name" => "Modifier un projet",
            ]);
        }
    
        /**
         * @Route("/admin/projets/{id}", name="projet_delete", methods={"DELETE"})
         */
        public function delete(Request $request, Projet $projet): Response
        {
            if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($projet);
                $entityManager->flush();
            }
    
            return $this->redirectToRoute('projet_index');
        }
    }


    // ---------------------- ARTICLES BLOG --------------------

    class ArticleController extends AbstractController
    {
        /**
         * @Route("/admin/blog", name="article_index", methods={"GET"})
         */
        public function index(ArticleRepository $articleRepository): Response
        {
            return $this->render('article/index.html.twig', [
                'articles' => $articleRepository->findAll(),
                "name" => "Gérer votre blog",
            ]);
        }

        /**
         * @Route("/admin/blog/new", name="article_new", methods={"GET","POST"})
         */
        public function new(Request $request): Response
        {
            $article = new Article();
            $form = $this->createForm(ArticleType::class, $article);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirectToRoute('article_index');
            }

            return $this->render('article/new.html.twig', [
                'article' => $article,
                'form' => $form->createView(),
                "name" => "Ajouter un article",
            ]);
        }

        /**
         * @Route("/blog/{id}", name="article_show",  methods={"GET","POST"}, requirements={"id":"\d+"})
         */
        public function show(Article $article, Request $request): Response
        {
            // $comments = $this->getDoctrine()->getRepository(Comment::class)->findAll();
            $currentId = $article ->getId($request);
            $articleKeyWords = $article->getKeyWords();
            $articleTitle = $article-> getTitle();
            $lastestArticles = $this->getDoctrine()->getRepository(Article::class)->findBy([],['createdAt' => 'ASC'],5);
            $repo = $this->getDoctrine()->getRepository(Article::class)->findBy(array('keyWords' => $articleKeyWords),array('id' => 'desc'),2 );
            
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
            $form->handleRequest($request);
            // dump($comments);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $comment->setCreatedAt(new \DateTime())
                        ->setArticle($article);
                $manager->persist($comment);
                $manager->flush();

                return $this->redirectToRoute('article_show', ['id'=> $article->getId()]);
            }

            return $this->render('article/show.html.twig', [
                'articleByKeyWords' => $repo,
                'article' => $article,
                'comment' => $comment,
                'lastestArticles' => $lastestArticles,
                "name" => $articleTitle,
                "currentId" => $currentId,
                "commentForm" => $form->createView(),
            ]);
        }

        /**
         * @Route("/admin/blog/{id}/edit", name="article_edit", methods={"GET","POST"})
         */
        public function edit(Request $request, Article $article): Response
        {
            $form = $this->createForm(ArticleType::class, $article);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('article_index');
            }

            return $this->render('article/edit.html.twig', [
                'article' => $article,
                'form' => $form->createView(),
                "name" => "Modifier un article",
            ]);
        }

        /**
         * @Route("/admin/blog/{id}", name="article_delete", methods={"DELETE"})
         */
        public function delete(Request $request, Article $article): Response
        {
            if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($article);
                $entityManager->flush();
            }

            return $this->redirectToRoute('article_index');
        }

        
    }
