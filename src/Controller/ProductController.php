<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_detail')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Fetch one product from the database (or create a sample one if empty)
        $product = $entityManager->getRepository(Product::class)->findOneBy([]);

        if (!$product) {
            $product = new Product();
            $product->setName('phone');
            $product->setPrice(50000.00);
            $product->setDescription('This is Laptop.');

            $entityManager->persist($product);
            $entityManager->flush();
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }
    
}
