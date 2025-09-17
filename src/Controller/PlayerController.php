<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use Doctrine\ORM\EntityManager;
use App\Repository\PlayerRepository;
use Symfony\Component\DomCrawler\Form;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        return $this->render('game/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/player/edit/{id}', name: 'edit_player')]
    public function editPlayer(int $id): Response
    {
        $player = $this->playerRepository->find($id);

        $player->setName('Yoshi');
        $this->entityManager->flush();

        return new Response('Le joueur {id} a bien été mis à jour.');
    }

    #[Route('/player/delete/{id}', name: 'delete_player')]
    public function deletePlayer(int $id): Response
    {
        $player = $this->playerRepository->find($id);

        if ($player) {
            $this->entityManager->remove($player);
            $this->entityManager->flush();
        }

        return new Response('Le joueur ' . $player->getName() . ' a bien été supprimé. - <a href="' . $this->generateUrl('app_players') . '">Retour à la liste des joueurs</a>');
    }
}