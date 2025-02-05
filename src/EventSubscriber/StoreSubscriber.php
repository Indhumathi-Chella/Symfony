<?php
namespace App\EventSubscriber;

use App\Event\OrderPlacedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StoreSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            OrderPlacedEvent::NAME => 'onPlacedOrder',
        ];
    }

    public function onPlacedOrder(OrderPlacedEvent $event): void
    {
        $order = $event->getOrder();
        dump("Subscriber: Order ID " . $order->getId() . " placed with status: " . $order->getStatus());
    }
}
