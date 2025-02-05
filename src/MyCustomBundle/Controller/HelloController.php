<?php


// src/MyCustomBundle/Controller/HelloController.php
namespace App\MyCustomBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    #[Route('/hello-bundle', name: 'hello_bundle')]
    public function index(): Response
    {
        return new Response('Hello from My Custom Bundle!');
    }
}
