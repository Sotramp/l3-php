<?php

namespace App\Controller;

use GuzzleHttp\Client;

class ToDoController extends AbstractController
{

    public function view()
    {
        $todolist = [];
        $client = new Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos');
        $body = $response->getBody();
        $todolist = json_decode($body, true);
        echo $this->render('todolist.phtml', ['todolist' => $todolist]);
    }
}