<?php
namespace App\Controller;

use App\Entity\Order;
use App\Event\OrderPlacedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class OrderController extends AbstractController
{
    #[Route('/order/place', name: 'order_place')]
    public function placeOrder(EventDispatcherInterface $eventDispatcher, EntityManagerInterface $entityManager): Response
    {
        // Create a new order instance
        $order = new Order(1, 'pending'); // Order ID = 1, status = 'pending'

        // to database
        $entityManager->persist($order);
        $entityManager->flush();

        // Create and dispatch the event
        $event = new OrderPlacedEvent($order);
        $eventDispatcher->dispatch($event, OrderPlacedEvent::NAME); // Dispatch the event

        // dd('Event dispatched for Order ID: ' . $order->getId());

        return new Response('Order placed with ID ' . $order->getId());
    }
}
