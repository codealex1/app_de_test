<?php

namespace App\Controller;
use App\Form\MailerType;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;



class MailerController extends AbstractController
{
    #[Route('/mail', name: 'mail', methods:['GET','POST'])]
    public function sendEmailAction(Request $request, MailerInterface $mailer , UserRepository $UserRepository): Response
{
    $user = new User();
    $form = $this->createForm(MailerType::class,$user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        
        
        
        $adress = $user->getEmail();

        $email = (new Email())
            ->from('didierdeschamps@example.com')
            ->to('email@gmail.com')
            ->subject('Coupe du monde')
            ->text('vous êtes invité à la prochaine coupe du monde');

       $mailer->send($email);

       return $this->redirectToRoute('app_contact', [],Response::HTTP_SEE_OTHER);

    }

    return $this->render('mailer/index.html.twig',[
        'user'=>$user,
        'form'=> $form->createView(),
    ]);




    }


}