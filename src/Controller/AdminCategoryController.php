<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminCategoryController extends AbstractController
{
	/**
	 * @Route("/categories/", name="admin_category_index")
	 */
	public function categoryIndex(ManagerRegistry $doctrine): Response
	{
		$repository = $doctrine->getRepository(Category::class);
		$categories = $repository->findAll();

		return $this->render('admin/categories/index.html.twig', [
			'categories' => $categories,
		]);
	}

	/**
	 * @Route("/categories/add/", name="admin_categories_add")
	 */
	public function add(ManagerRegistry $doctrine, Request $request): Response
	{
		$category = new Category();
		$form = $this->createForm(CategoryType::class, $category);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $doctrine->getManager();
			$em->persist($category);
			$em->flush();

			return $this->redirectToRoute('admin_category_index');
		}

		return $this->render('admin/categories/create.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/categories/edit/{id}", name="admin_categories_edit")
	 */
	public function edit(ManagerRegistry $doctrine, Request $request, $id): Response
	{
		$repository = $doctrine->getRepository(Category::class);
		$category = $repository->find($id);
		$form = $this->createForm(CategoryType::class, $category);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $doctrine->getManager();
			$em->flush();

			return $this->redirectToRoute('admin_category_index');
		}

		return $this->render('/admin/categories/edit.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/categories/delete/{id}", name="admin_categories_delete")
	 */
	public function delete(ManagerRegistry $doctrine, Request $request, $id): Response
	{
		$repository = $doctrine->getRepository(Category::class);
		$category = $repository->find($id);
		$em = $doctrine->getManager();

		$em->remove($category);
		$em->flush();

		return $this->redirectToRoute("admin_category_index");
	}
}
