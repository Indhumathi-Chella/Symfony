<?php

// src/Controller/BlogApiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogApiController extends AbstractController
{
    #[Route('/api/posts', methods: ['GET'])]
    public function list(): Response
    {
        return new Response('List of all blog posts');
    }

    #[Route('/api/posts/{id}', methods: ['GET'])]
    public function show(int $id): Response
    {
        return new Response("Showing blog post with ID: $id");
    }

    #[Route('/api/posts', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = $request->request->all();
        return new Response('Blog post created with data: ' . json_encode($data));
    }

    #[Route('/api/posts/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request): Response
    {
        $data = $request->request->all();
        return new Response("Updated blog post $id with data: " . json_encode($data));
    }

    #[Route('/api/posts/{id}', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        return new Response("Deleted blog post with ID: $id");
    }
}
