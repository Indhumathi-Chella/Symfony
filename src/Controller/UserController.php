<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    
    #[Route('/user/new', name: 'user_form')]
    public function new(Request $request): Response
    {
       
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        // dump($form->createView()); 
        // die(); 

        
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('user_success');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }

    #[Route('/user/success', name: 'user_success')]
   
    public function success(): Response
    {
        return new Response('Form submitted successfully!');
    }
}
