<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    public function home()
    {
        //echo 'Page d\'accueil';
        echo $this->render('home.phtml', []);
    }
}