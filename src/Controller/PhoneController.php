<?php

// src/Controller/PhoneController.php
namespace App\Controller;

use App\Entity\Phone;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;


class PhoneController extends AbstractController
{
    #[Route('/phone', methods: ['GET'])]
    public function getPhone(SerializerInterface $serializer): JsonResponse
    {
        $phone = new Phone('Oneplus', '12R', 7999.99, new \DateTimeImmutable(), false);

        // Serialize for customers (exclude price)
        $jsonCustomer = $serializer->serialize($phone, 'json', ['groups' => 'customer']);

        // Serialize for admins (include full details)
        $jsonAdmin = $serializer->serialize($phone, 'json', ['groups' => 'admin']);

        return new JsonResponse([
            'customer_view' => json_decode($jsonCustomer, true),
            'admin_view' => json_decode($jsonAdmin, true)
        ]);
    }

    #[Route('/phone/custom', methods: ['GET'])]
    public function customSerialization(SerializerInterface $serializer): JsonResponse
    {
        $phone = new Phone('Samsung', 'Galaxy S22', 799.99, new \DateTimeImmutable(), true);

        // Skip null values, exclude 'price', and use a custom date format
        $json = $serializer->serialize($phone, 'json', [
            AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['price'],
            DateTimeNormalizer::FORMAT_KEY => 'd/m/Y'
        ]);

        return new JsonResponse(json_decode($json, true));
    }

    // Normalizing: Convert PHP object to array
    #[Route('/phone/normalize', methods: ['GET'])]
    public function normalizePhone(SerializerInterface $serializer): JsonResponse
    {
        $phone = new Phone('Apple', 'iPhone 13', 999.99, new \DateTimeImmutable(), true);

        // Normalize the Phone object to an array
        $phoneArray = $serializer->normalize($phone, null, ['groups' => 'admin']);
        
        return new JsonResponse([
            'message' => 'Phone details as array',
            'phone' => $phoneArray
        ]);
    }

    // Denormalizing: Convert array back to PHP object
    #[Route('/phone/denormalize', methods: ['POST'])]
    public function denormalizePhone(Request $request, SerializerInterface $serializer): JsonResponse
    {
        // Get the array data from the request body (JSON to array)
        $jsonData = $request->getContent();
        $phoneArray = json_decode($jsonData, true);

        // Denormalize the array back into a Phone object
        $phone = $serializer->denormalize($phoneArray, Phone::class);

        // Return the denormalized phone object in JSON format
        return new JsonResponse([
            'message' => 'Phone object created from array',
            'phone' => $serializer->serialize($phone, 'json', ['groups' => 'admin'])
        ]);
    }

    // Encoding: Convert PHP array to JSON
    #[Route('/phone/encode', methods: ['POST'])]
    public function encodePhone(EncoderInterface $serializer): JsonResponse
    {
        // Sample PHP array
        $phoneArray = [
            'brand' => 'Samsung',
            'model' => 'Galaxy S22',
            'price' => 799.99,
            'releaseDate' => '2025-02-06',
        ];

        // Encode the PHP array into JSON
        $json = $serializer->encode($phoneArray, 'json');

        return new JsonResponse([
            'message' => 'Phone encoded into JSON',
            'json' => $json
        ]);
    }

    // Decoding: Convert JSON into PHP array
    #[Route('/phone/decode', methods: ['POST'])]
    public function decodePhone(Request $request, DecoderInterface $serializer): JsonResponse
    {
        // Get the JSON input
        $jsonData = $request->getContent();

        // Decode the JSON data into a PHP array
        $phoneArray = $serializer->decode($jsonData, 'json');

        return new JsonResponse([
            'message' => 'Phone decoded from JSON',
            'phone' => $phoneArray
        ]);
    }
    
}
