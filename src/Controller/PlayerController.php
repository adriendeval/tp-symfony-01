<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\Form\FormFactoryInterface;

class PlayerController extends AbstractController
{
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;
    private FormFactoryInterface $formFactory;

    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    #[Route('/player/', name: 'app_player')]
    public function index(PlayerRepository $playerRepository): Response
    {
        $players = $playerRepository->findAll();

        return $this->render('player/index.html.twig', [
            'players' => $players,
        ]);
    }

    #[Route('/player/create', name: 'create_player')]
    public function create(Request $request): Response
    {
        $player = new Player();
        $form = $this->formFactory->create(PlayerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($player);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_player');
        }
    }



    #[Route('/player/update/{id}', name: 'update_player')]
    public function update(int $id): Response
    {
        $player = $this->playerRepository->find($id);

        $player->setName('Mario');
        $this->playerRepository->flush();

        return new Response('Le joueur {id} a bien été mis à jour.');
    }

    #[Route('/player/delete/{id}', name: 'delete_player')]
    public function delete(int $id): Response
    {
        $player = $this->playerRepository->find($id);

        if ($player) {
            $this->entityManager->remove($player);
            $this->entityManager->flush();
        }

        return new Response('Le joueur {id} a bien été supprimé.');
    }
}