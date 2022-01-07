<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
*/
class AdminController extends AbstractController
{
    /**
     * @Route("/projects/add/", name="admin_project_add")
     */
    public function add(): Response
    {
        return $this->render('admin/create.html.twig', [
            'method' => 'Add',
        ]);
    }

    /**
     * @Route("/projects/edit/{id}", name="admin_project_edit")
     */
    public function edit($id): Response
    {
        return $this->render('admin/edit.html.twig', [
            'method' => 'Edit',
        ]);
    }

    /**
     * @Route("/projects/delete/{id}", name="admin_project_delete")
     */
    public function delete($id): Response
    {
        return $this->render('admin/delete.html.twig', [
            'method' => 'Delete',
        ]);
    }
}
