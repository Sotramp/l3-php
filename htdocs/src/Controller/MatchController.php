<?php

namespace App\Controller;

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
        $client = new Client();
        $response = $client->request('GET', 'http://mathys-pomier.fr:4000/euro');
        $body = $response->getBody();
        $matchs = json_decode($body, true);
        return $this->render('matchs.html.twig', ['matchs' => $matchs]);
    }
}