<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController{
    // #[route('/ ' ,'name:index_page')]
    #[route('/index' ,name:'index_page')]
    #[Route('/api/posts/{id}', methods: ['GET', 'HEAD', 'PUT', 'DELETE'])]

    public function index() : Response{
        return new Response ("<h1>Hello from a controller</h1>");
    }
    // public function index() {
    //     echo "<h1>Hello from a controller</h1>";
    // }

}


?>