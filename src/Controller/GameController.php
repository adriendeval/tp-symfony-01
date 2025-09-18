<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class GameController extends AbstractController
{
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $entityManager)
    {
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_index')] // Annotation
    public function index(): Response
    {
        $info = "La partie n°1 est lancée";
        return $this->render('index.html.twig', [
            'information' => $info
        ]);
    }
}