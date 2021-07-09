<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Repository\BetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="account")
     */
    public function index(BetRepository $betsRepositoy): Response
    {
        $bets = $betsRepositoy->findBy(['id_user' => $this->getUser()->getId()]);
        $matchs = MatchController::getMatchs();
        return $this->render('account/account.html.twig', [
            'bets' => $bets,
            'matchs' => $matchs
        ]);
    }
}
