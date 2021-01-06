<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        // $this->addFlah('info', 'Quelques informations utiles');

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            $email = (new Email())
                ->from($contactFormData['from'])
                ->to('patrick.croquet@afpa.fr')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('patrick@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer!')
                //->text('Sending emails is fun again!')
                //->html('<p>See Twig integration for better HTML integration!</p>');
                ->text($contactFormData['message']);

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé !');

            return $this->redirectToRoute('contact');

        }    
        
        return $this->render('contact/index.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
