<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user", name="user_profile")
     */
    public function index(): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
