<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuyerController extends AbstractController
{
    /**
     * @Route("/buyer", name="buyer")
     */
    public function index(): Response
    {
        return $this->render('buyer/index.html.twig', [
            'controller_name' => 'BuyerController',
        ]);
    }
}
