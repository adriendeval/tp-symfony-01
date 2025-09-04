<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    #[Route('/', name: 'app_index')] // Annotation
    public function index(): Response
    {
        $info = "La partie n°1 est lancée";
        return $this->render('index.html.twig', [
            'information' => $info
        ]);
    }

    #[Route('/go/{id}', name: 'app_go')]
    public function go(int $id): Response
    {
        $info = "La partie n°$id est lancée";
        return new Response($info);
    }
}