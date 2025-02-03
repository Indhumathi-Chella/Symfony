<?php 

// src/Controller/SimpleController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SimpleController extends AbstractController
{
    // Basic GET request returning plain text
    #[Route('/hello', name: 'hello', methods: ['GET'])]
    public function hello(): Response
    {
        return new Response('Hello, Symfony!');
    }

    // Dynamic route with a parameter
    #[Route('/hello/{name}', name: 'hello_name', methods: ['GET'])]
    public function helloName(string $name): Response
    {
        return new Response("Hello, $name!");
    }

    // Rendering a Twig template
    #[Route('/greet/{name}', name: 'greet', methods: ['GET'])]
    public function greet(string $name): Response
    {
        return $this->render('greet.html.twig', ['name' => $name]);
    }

    //  JSON Response (API endpoint)
    #[Route('/api/data', name: 'api_data', methods: ['GET'])]
    public function apiData(): JsonResponse
    {
        return $this->json(['message' => 'Hello, API!', 'status' => 200]);
    }

    // Redirect to another route
    #[Route('/redirect', name: 'redirect_example', methods: ['GET'])]
    public function redirectExample(): RedirectResponse
    {
        return $this->redirectToRoute('hello');
    }

    // Handling POST requests (Form submission)
    #[Route('/submit', name: 'submit_form', methods: ['POST'])]
    public function submit(Request $request): Response
    {
        $name = $request->request->get('name', 'Guest');
        return new Response("Form submitted! Hello, $name.");
    }

    // Handling PUT requests (Updating data)
    #[Route('/update', name: 'update_data', methods: ['PUT'])]
    public function update(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        return $this->json(['message' => 'Data updated', 'data' => $data]);
    }

    // Handling DELETE requests (Deleting data)
    #[Route('/delete/{id}', name: 'delete_data', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        return $this->json(['message' => "Record with ID $id deleted."]);
    }

    //  File download response
    #[Route('/download', name: 'download_file', methods: ['GET'])]
    public function download(): BinaryFileResponse
    {
        $filePath = '/path/to/file.pdf'; // Change to an actual file path
        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('File not found');
        }
        return $this->file($filePath);
    }

    //  Flash message and redirect
    #[Route('/flash', name: 'flash_message', methods: ['GET'])]
    public function flashMessage(): RedirectResponse
    {
        $this->addFlash('success', 'Action completed successfully!');
        return $this->redirectToRoute('hello');
    }

    //  Handling session data
    #[Route('/session', name: 'session_example', methods: ['GET'])]
    public function sessionExample(Request $request): Response
    {
        $session = $request->getSession();
        $session->set('user', 'Indhu');
        return new Response("Session set for user: " . $session->get('user'));
    }

    //  Throwing a 404 error if something is not found
    #[Route('/error/{id}', name: 'error_example', methods: ['GET'])]
    public function errorExample(int $id): Response
    {
        if ($id > 10) {
            throw $this->createNotFoundException('Item not found');
        }
        return new Response("Item ID: $id is available.");
    }
}
