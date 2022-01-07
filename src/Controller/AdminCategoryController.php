<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
	public function projectsIndex(): Response
	{
		return $this->render('admin/categories/index.html.twig', [
			'method' => 'Index',
		]);
	}

	/**
	 * @Route("/categories/add/", name="admin_categories_add")
	 */
	public function add(): Response
	{
		return $this->render('admin/categories/create.html.twig', [
			'method' => 'Add',
		]);
	}

	/**
	 * @Route("/categories/edit/{id}", name="admin_categories_edit")
	 */
	public function edit($id): Response
	{
		return $this->render('admin/categories/edit.html.twig', [
			'method' => 'Edit',
		]);
	}

	/**
	 * @Route("/categories/delete/{id}", name="admin_categories_delete")
	 */
	public function delete($id): Response
	{
		return $this->render('admin/categories/delete.html.twig', [
			'method' => 'Delete',
		]);
	}
}
