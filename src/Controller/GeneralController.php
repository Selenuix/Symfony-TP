<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;

class GeneralController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Project::class);
		$projects = $repository->findAll();

        return $this->render('index.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

	/**
	 * @Route("/contact", name="contact")
	 * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
	 */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
	    $form = $this->createForm(ContactType::class);

	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
		    $contactFormData = $form->getData();

		    $message = (new Email())
			    ->from($contactFormData['email'])
			    ->to('selenuix.temp@gmail.com')
			    ->subject('You got mail')
			    ->text('Sender : '.$contactFormData['email'].\PHP_EOL. $contactFormData['message'],
				    'text/plain');
		    $mailer->send($message);

		    $this->addFlash('success', 'Your message has been sent');

		    return $this->redirectToRoute('contact');
	    }

	    return $this->render('contact.html.twig', [
		    'form' => $form->createView(),
	    ]);
    }
}
