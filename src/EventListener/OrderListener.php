<?php

namespace App\EventListener;

use App\Event\OrderPlacedEvent;

class OrderListener
{
    public function onOrderPlaced(OrderPlacedEvent $event): void
    {
        $order = $event->getOrder();
        // Here we can perform actions like sending email or logging
        dd("Order placed with ID: " . $order->getId() . " and status: " . $order->getStatus());
    }
}
