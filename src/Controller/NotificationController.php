<?php

namespace App\Controller;

use App\Service\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends AbstractController
{
    public function notify(): Response
    {
        // Symfony automatically injects the User service
        $user = $this->get(Users::class);
        $user->notify("Hello, you have a new message!");

        return new Response('Notification sent!');
    }
}
