<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    /**
     * @Route("/todolist", name="todolist")
     */
    public function view()
    {
        $todolist = [];
        $client = new Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos');
        $body = $response->getBody();
        $todolist = json_decode($body, true);
        return $this->render('todolist.html.twig', ['todolist' => $todolist]);
    }
}