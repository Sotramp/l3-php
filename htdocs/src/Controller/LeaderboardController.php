<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Repository\BetRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeaderboardController extends AbstractController
{
    /**
     * @Route("/classement", name="leaderboard")
     */
    public function index(BetRepository $betsRepository, UserRepository $userRepository): Response
    {
        return $this->render('leaderboard/index.html.twig', [
            'classement' => self::getLeaderboard($betsRepository, $userRepository),
        ]);
    }

    public static function getLeaderboard(BetRepository $betsRepository, UserRepository $userRepository)
    {
        $leaderboard = [];
        $bets = $betsRepository->findAll();
        $users = $userRepository->findAll();
        $matchs = MatchController::getMatchs();

        foreach ($users as $user) {
            $points = 0;
            foreach ($bets as $bet) {
                if ($bet->getIdUser() === $user->getId()) {
                    foreach ($matchs as $match) {
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

            $new_user = ['email' => $user->getEmail(), 'points' => $points];
            array_push($leaderboard, $new_user);
        }

        uasort($leaderboard, function ($item, $compare) {
            return $item['points'] <= $compare['points'];
        });

        return $leaderboard;
    }
}
