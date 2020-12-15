<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/producteur", name="productor_")
 * @IsGranted("ROLE_PRODUCTOR")
 */
class ProductorController extends AbstractController
{
    /**
     * @Route("/", name="all")
     */
    public function index(): Response
    {
        return $this->render('productor/index.html.twig', [
            'controller_name' => 'ProductorController',
        ]);
    }
}
