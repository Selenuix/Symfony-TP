<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
*/
class AdminProjectController extends AbstractController
{
	/**
	 * @Route("/projects/", name="admin_project_index")
	 */
	public function projectsIndex(ManagerRegistry $doctrine): Response
	{
		$repository = $doctrine->getRepository(Project::class);
		$projects = $repository->findAll();

		return $this->render('admin/projects/index.html.twig', [
			'projects' => $projects,
		]);
	}

    /**
     * @Route("/projects/add/", name="admin_project_add")
     */
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
	    $project = new Project();
	    $form = $this->createForm(ProjectType::class, $project);

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
		    $em = $doctrine->getManager();
		    $em->persist($project);
		    $em->flush();

		    return $this->redirectToRoute('admin_project_index');
	    }

	    return $this->render('admin/projects/create.html.twig', [
		    'form' => $form->createView()
	    ]);
    }

    /**
     * @Route("/projects/edit/{id}", name="admin_project_edit")
     */
    public function edit(ManagerRegistry $doctrine, Request $request, $id): Response
    {
	    $repository = $doctrine->getRepository(Project::class);
	    $category = $repository->find($id);
	    $form = $this->createForm(ProjectType::class, $category);

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
		    $em = $doctrine->getManager();
		    $em->flush();

		    return $this->redirectToRoute('admin_project_index');
	    }

	    return $this->render('/admin/projects/edit.html.twig', [
		    'form' => $form->createView()
	    ]);
    }

    /**
     * @Route("/projects/delete/{id}", name="admin_project_delete")
     */
    public function delete(ManagerRegistry $doctrine, Request $request, $id): Response
    {
	    $repository = $doctrine->getRepository(Project::class);
	    $project = $repository->find($id);
	    $em = $doctrine->getManager();

	    $em->remove($project);
	    $em->flush();

	    return $this->redirectToRoute("admin_project_index");
    }
}
