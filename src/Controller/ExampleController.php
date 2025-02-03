<?php


// src/Controller/ExampleController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ExampleController extends AbstractController
{
    //Creating a Basic Route
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return new Response('<html><body>Welcome to Symfony Routing!</body></html>');
    }

    // Creating Routes as Attributes
    #[Route('/attribute-route', name: 'attribute_route')]
    public function attributeRoute(): Response
    {
        return new Response('<html><body>Route defined as an attribute!</body></html>');
    }

    

    // HTTP Methods
    #[Route('/submit', name: 'submit_form', methods: ['POST'])]
    public function submitForm(): Response
    {
        return new Response('<html><body>Form submitted!</body></html>');
    }

    //Matching Expressions (IP restriction)
    #[Route('/secure-area', name: 'secure_area', condition: "request.getClientIp() == '127.0.0.1'")]
    public function secureArea(): Response
    {
        return new Response('<html><body>Access granted!</body></html>');
    }

    // Debugging Routes: Run `php bin/console debug:router`

    // Route with Parameters
    #[Route('/product/{id}', name: 'product_show', requirements: ['id' => '\d+'])]
    public function showProduct(int $id): Response
    {
        return new Response("<html><body>Product ID: $id</body></html>");
    }

    // Parameters Validation (Regex constraint)
    #[Route('/users/{name}', name: 'user_profile', requirements: ['name' => '[A-Za-z]+'])]
    public function userProfile(string $name): Response
    {
        return new Response("<html><body>Welcome, $name!</body></html>");
    }

    // Optional Parameters
    #[Route('/profile/{id}', name: 'profile', defaults: ['id' => 1])]
    public function profile(int $id): Response
    {
        return new Response("<html><body>Profile ID: $id</body></html>");
    }

    // Backed Enum Parameters
    #[Route('/order/{status}', name: 'order_status', requirements: ['status' => 'pending|shipped|delivered'])]
    public function orderStatus(string $status): Response
    {
        return new Response("<html><body>Order Status: $status</body></html>");
    }

    // Special Parameters 
    #[Route('/{_locale}/about', name: 'about_page', requirements: ['_locale' => 'en|fr'])]
    public function aboutPage(string $_locale): Response
    {
        return new Response("<html><body>About Page in $_locale</body></html>");
    }

    // Route Aliasing - multi route for one method
    #[Route('/old-url', name: 'old_route')]
    #[Route('/new-url', name: 'new_route')]
    public function aliasedRoute(): Response
    {
        return new Response("<html><body>Aliased Route</body></html>");
    }

    // Getting the Route Name and Parameters
    #[Route('/current-route', name: 'current_route')]
    public function currentRoute(Request $request): Response
    {
        $routeName = $request->attributes->get('_route');
        return new Response("<html><body>Current Route: $routeName</body></html>");
    }

    // Special Routes (e.g., catch-all)
    // #[Route('/{any}', name: 'catch_all', requirements: ['any' => '.*'])]
    // public function catchAll(): Response
    // {
    //     return new Response('<html><body>404 - Page Not Found</body></html>', 404);
    // }

    // Rendering a Template from a Route
    #[Route('/template', name: 'render_template')]
    public function renderTemplate(): Response
    {
        return $this->render('index.html.twig'); // Requires example.html.twig in templates/
    }

    // Redirecting to Another Route
    #[Route('/go-home', name: 'redirect_home')]
    public function redirectHome(): Response
    {
        return $this->redirectToRoute('home');
    }

    // Sub-Domain Routing
    #[Route('/dashboard', name: 'dashboard', host: '{subdomain}.example.com', requirements: ['subdomain' => 'admin|user'])]
    public function dashboard(string $subdomain): Response
    {
        return new Response("<html><body>Welcome to the $subdomain dashboard!</body></html>");
    }

    // Stateless Routes (Useful for APIs)
    #[Route('/api/data', name: 'api_data', stateless: true)]
    public function apiData(): Response
    {
        return new Response(json_encode(['message' => 'API Data']), 200, ['Content-Type' => 'application/json']);
    }

    // Generating URLs in Controllers
    #[Route('/generate-url', name: 'generate_url')]
    public function generateUrlExample(UrlGeneratorInterface $urlGenerator): Response
    {
        $url = $urlGenerator->generate('product_show', ['id' => 123]);
        return new Response("<html><body>Generated URL: $url</body></html>");
    }

    // Generating URLs in Services, Templates, JavaScript, and Commands (See `twig` functions)

    // Checking if a Route Exists
    #[Route('/check-route/{routeName}', name: 'check_route')]
    public function checkRoute(string $routeName, UrlGeneratorInterface $router): Response
    {
        try {
            $url = $router->generate($routeName);
            return new Response("<html><body>Route exists: $url</body></html>");
        } catch (\Exception $e) {
            return new Response("<html><body>Route does not exist</body></html>");
        }
    }

}

?>