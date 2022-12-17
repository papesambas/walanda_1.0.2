<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogistiqueController extends AbstractController
{
    #[Route('/logistique', name: 'app_logistique')]
    public function index(): Response
    {
        return $this->render('logistique/index.html.twig', [
            'controller_name' => 'LogistiqueController',
        ]);
    }
}
