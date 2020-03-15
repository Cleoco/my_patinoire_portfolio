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
         * @Route("/admin/projets/{id}", name="projet_show", methods={"GET"})
         */
        public function show(Projet $projet): Response
        {
            $projetTitle = $projet-> getTitle();
            return $this->render('projet/show.html.twig', [
                'projet' => $projet,
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