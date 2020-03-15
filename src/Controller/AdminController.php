<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
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
     * @Route("/category", name="category_index", methods={"GET"})
     */
    public function categoryList(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            "name" => "Vos prestations"
        ]);
    }

    /**
     * @Route("/category/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
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
            "name" => "Ajouter une prestation"
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show", methods={"GET"})
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
     * @Route("/category/{id}/edit", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
            "name" => "Modifier une prestation"
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_delete", methods={"DELETE"})
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


// ---------------------- CATEGORIES --------------------