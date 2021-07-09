<?php

namespace App\Controller;

use App\Entity\Bet;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MatchController extends AbstractController
{
    /**
     * @Route("/matchs", name="matchs")
     */
    public function view(UserInterface $user)
    {
        $todolist = [];
        $matchs = $this->getMatchs();
        return $this->render('matchs.html.twig', ['matchs' => $matchs]);
    }

    /**
     * @Route("/add_bet", name="add_bet", methods={"POST"})
     */
    public function add_bet()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $bet = new Bet();
        $bet->setIdUser($this->getUser()->getId());
        $bet->setIdMatch($_POST['id_match']);
        $bet->setBetHome($_POST['bet_home']);
        $bet->setBetExt($_POST['bet_ext']);

        $entityManager->persist($bet);
        $entityManager->flush();

        return $this->redirectToRoute('matchs');
    }

    public static function getMatchs()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://mathys-pomier.fr:4000/euro');
        $body = $response->getBody();
        return json_decode($body, true);
    }
}