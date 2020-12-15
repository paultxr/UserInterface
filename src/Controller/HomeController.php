<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class);
        return $this->render('home/index.html.twig', [
            "products" => $products->findAll()
        ]);
    }
}
