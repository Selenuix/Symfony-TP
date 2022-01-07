<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projects")
*/
class ProjectsController extends AbstractController
{
    /**
     * @Route("/", name="projects_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
	    $repository = $doctrine->getRepository(Project::class);
	    $projects = $repository->findAll();

	    return $this->render('projects/index.html.twig', [
		    'projects' => $projects,
	    ]);
    }

    /**
     * @Route("/{id}", name="project_show")
     */
    public function showProject($id, ManagerRegistry $doctrine): Response
    {
	    $repository = $doctrine->getRepository(Project::class);
	    $project = $repository->find($id);

	    return $this->render('projects/show.html.twig', [
		    "project" => $project,
	    ]);
    }
}
