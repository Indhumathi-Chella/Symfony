<?php

// src/Controller/PersonController.php
namespace App\Controller;

use App\Model\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends AbstractController
{
    public function index(SerializerInterface $serializer): Response
    {
        $student = new Student('Indhu', 22, true);

        $jsonContent = $serializer->serialize($student, 'json');
        // $jsonContent contains {"name":"Jane Doe","age":39,"sportsperson":false}

        return JsonResponse::fromJsonString($jsonContent);
    }

    public function create(Request $request, SerializerInterface $serializer): Response
    {
        // Example JSON data
        $jsonData = '{"name":"Anvi","age":22,"passed":true}';
    
        // Deserialize JSON data to Student object
        $student = $serializer->deserialize($jsonData, Student::class, 'json');
    
        
        return new Response('Students have been processed.', Response::HTTP_OK);
    }
}