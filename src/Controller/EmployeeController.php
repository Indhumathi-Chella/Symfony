<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee/new', name: 'employee_form')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employee_success');
        }

        return $this->render('employee/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/employee/success', name: 'employee_success')]
    public function success(): Response
    {
        return new Response('<h1>Employee added successfully!</h1>');
    }
}
