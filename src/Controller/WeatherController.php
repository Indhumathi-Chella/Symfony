<?php

// src/Controller/WeatherController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route; 

class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'weather_index')]
    public function index(): Response
    {
        $city = 'chennai';
        $apiKey = $_ENV['OPENWEATHER_API_KEY']; // Get API key .env

        $client = HttpClient::create();
        $temperature = null;
        $condition = null;
        $errorMessage = null;

        
        try {
            $response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'q' => $city,
                    'appid' => $apiKey,
                    'units' => 'metric',
                ]
            ]);

            
            if ($response->getStatusCode() === 200) {
                $weatherData = $response->toArray();
                $temperature = $weatherData['main']['temp'];
                $condition = $weatherData['weather'][0]['description'];
            } else {
                $errorMessage = 'Failed to retrieve weather data.';
            }
        } catch (TransportExceptionInterface $e) {
            $errorMessage = 'Network error: ' . $e->getMessage();
        }

        return $this->render('weather/index.html.twig', [
            'city' => $city,
            'temperature' => $temperature,
            'condition' => $condition,
            'errorMessage' => $errorMessage,
        ]);

        dd($response);
        dump($response->getStatusCode(), $response->getContent());
        die();
        
    }
}
