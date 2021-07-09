<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Repository\BetRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="account")
     */
    public function index(BetRepository $betsRepository, UserRepository $userRepository): Response
    {
        $bets = $betsRepository->findBy(['id_user' => $this->getUser()->getId()]);
        $matchs = MatchController::getMatchs();
        $points = 0;

        foreach ($bets as $bet)
        {
            if ($bet->getIdUser() === $this->getUser()->getId())
            {
                foreach ($matchs as $match)
                {
                    if (isset($match['scores']['winner'])) {
                        if ($bet->getBetHome() == $match['scores']['domicile'] && $bet->getBetExt() == $match['scores']['exterieur']) {
                            $points += 3;
                        } else {
                            if ($bet->getBetHome() > $bet->getBetExt() && $match['scores']['winner'] == 'domicile') {
                                $points++;
                            } else if ($bet->getBetHome() < $bet->getBetExt() && $match['scores']['winner'] == 'exterieur') {
                                $points++;
                            }
                        }
                    }
                }
            }
        }

        $classement = LeaderboardController::getLeaderboard($betsRepository, $userRepository);
        $cpt = 1;
        foreach ($classement as $user) {
            if ($user['email'] === $this->getUser()->getEmail()) {
                $classement = $cpt;
            }
            $cpt++;
        }

        return $this->render('account/account.html.twig', [
            'bets' => $bets,
            'matchs' => $matchs,
            'points' => $points,
            'classement' => $classement
        ]);
    }
}
