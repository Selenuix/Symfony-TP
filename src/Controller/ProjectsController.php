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
     * @Route("/", name="projects")
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
     * @Route("/{slug}", name="project")
     */
    public function show($slug): Response
    {
        return $this->render('projects/show.html.twig', [
            'controller_name' => 'ProjectsController',
            'slug' => $slug,
        ]);
    }
}
