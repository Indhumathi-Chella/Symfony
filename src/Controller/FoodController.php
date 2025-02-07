<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    // Store a favorite food in the session
    #[Route('/store-favorite-food', name: 'store_favorite_food')]
    public function storeFavoriteFood(Request $request, SessionInterface $session): Response
    {
        // Set max idle time to 10 seconds for immediate testing
        $maxIdleTime = 10; // 10 seconds

        // Start the session
        $session->start();

        // Check if session has expired based on last used time
        if (time() - $session->getMetadataBag()->getLastUsed() > $maxIdleTime) {
            // Invalidate the session if it's expired
            $session->invalidate();

            // Redirect to the expired session page
            return $this->redirectToRoute('session_expired');
        }

        // Retrieve the 'food' parameter from the form, default to 'Pizza' if not specified
        $food = $request->get('food', 'Pizza'); // Default food if not specified

        // Store food in the session
        $session->set('favorite_food', $food);

        // Add flash message
        $this->addFlash('success', 'Your favorite food has been saved!');

        return $this->redirectToRoute('show_favorite_food');
    }

    // Show the favorite food from the session
    #[Route('/show-favorite-food', name: 'show_favorite_food')]
    public function showFavoriteFood(SessionInterface $session): Response
    {
        // Retrieve the favorite food from the session
        $food = $session->get('favorite_food', 'No favorite food set yet');

        return $this->render('food/show.html.twig', [
            'food' => $food,
        ]);
    }

    // Session expired page
    #[Route('/session-expired', name: 'session_expired')]
    public function sessionExpired(): Response
    {
        return $this->render('food/expired_session.html.twig');
    }
}
