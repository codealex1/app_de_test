<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    public function sendEmailAction(Request $request, MailerInterface $mailer): Response
{

   $email = (new Email())
       ->from('didierdeschamps@example.com')
       ->to('zinedine@example.com')
       ->subject('Coupe du monde')
       ->text('vous êtes invité à la prochaine coupe du monde');

   $mailer->send($email);
    }

}
